<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['confirmEmail','index','show', 'create', 'store']);

        $this->middleware('guest')->only('create');

        $this->middleware('throttle:10,60')->only('store');
    }

    public function index(): View|Application|Factory
    {
        $users = User::paginate($this->perPage);
        return view('users.index', compact('users'));
    }

    /**
     * @return Factory|Application|View
     */
    public function create(): Factory|Application|View
    {
        return view('users.create');
    }

    public function show(User $user): Factory|Application|View
    {
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('users.show', compact('user', 'statuses'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */

    public function store(Request $request): RedirectResponse
    {

        //请求验证
        $validated = $request->validate(
        [   'name' => 'required|max:50|unique:users|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        $this->sendEmailConfirmationTo($user);

//        auth()->login($user);
        return redirect()->route('home', ['user' => $user])->with('success', "已经发送激活邮件");
    }

    public function edit(User $user): Factory|Application|View
    {
        $this->authorize('update', $user);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);
        $request->validate([
            'name' => 'required|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = $request->only(['name']);
        if($request->filled('password')){
            $data = $request->only(['name', 'password']);
        }
        $user->update($data);

        return redirect()->route('home', ['user' => $user])->with('success', "success,Please check your email to activate your account");
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('destroy', $user);

        $user->delete();

        return redirect()->route('users.index')->with('success', "success");
    }

    protected  function sendEmailConfirmationTo(User $user): void
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'liang@liang.com';
        $name = 'liang';
        $to = $user->email;
        $subject = '请确认你的邮箱Confirm your account';

        //发邮件
        Mail::send($view, $data, function ($message) use ( $to, $subject) {
            $message->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token): RedirectResponse
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activation_token = null;
        $user->activated = true;
        $user->save();

        auth()->login($user);
        return redirect()->route('users.show', ['user' => $user])->with('success', "已激活成功，正在跳转主页");

    }

    public function followings(User $user): View
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name;
        return view('users.show_follow', compact('users', 'title'));
    }

    public function followers(User $user): View
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . ' 的粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }


}
