<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{

    public function __construct()
    {
        //1分钟3次
        $this->middleware('throttle:30,1')->only(['sendResetLinkEmail']);
    }

    public function showLinkRequestForm(): Factory|View|Application
    {
        return  view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        //验证邮箱
        $request->validate(['email' => 'required|email']);
        $email = request('email');

        //获取对应的用户
        $user = User::where('email', $email)->first();
        //如果用户不存在，返回错误信息
        if(is_null($user)){
            return redirect()->back()->withInput()->with('danger', 'This email address is not registered.' );
        }
        //如果用户存在，生成密码token,会在 emails.reset_link 里面拼接链接
        $token = hash_hmac('sha256', str::random(40), config('app.key'));

        //将token，email存入数据库,用updateOrInsert保持邮箱唯一
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token),
            'created_at' => new Carbon
            ]);
        //发送邮件
        Mail::send('emails.reset_link', ['token' => $token], function ($message) use ($email) {
            $message->to($email)->subject('Reset Password');
        });

        //返回成功信息
        return redirect()->back()->withInput()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request): Factory|View|Application
    {
        $token = $request->route()->parameter('token');
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function reset(Request $request): RedirectResponse
    {
        //验证数据
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $email = $request->input('email');
        $token = $request->input('token');
        $expires = 60 * 10;

        //获取对应的用户

        $user = User::where('email', $email)->first();

        //如果用户不在，返回错误信息
        if(is_null($user)){
            return redirect()->back()->withInput()->with('danger', 'This email address is not registered.' );
        }

        //获取重置密码纪录
        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        //如果没有记录返回错误信息
        if(!$record){
            return redirect()->back()->withInput()->with('danger', 'This email address is not registered.' );
        }

        //如果token不匹配，返回error
        if(!Hash::check($token, $record->token)){
            return redirect()->back()->withInput()->with('danger', 'Invalid token.' );
        }

        //如果token过期
        if(Carbon::now()->diffInSeconds() > $expires){
            return redirect()->back()->withInput()->with('danger', 'Your password has expired.' );
        }

        //正常跟新
        $user->update(['password' => bcrypt($request->input('password'))]);
        return redirect()->route('login')->with('success', 'Your password has been changed.' );
    }
}
