<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('create');
    }

    public function create(): Factory|View|Application
    {
        return view('sessions.create');
    }
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);
        //auth()->attempt(...) 会自动去数据库里找 email 对应的用户，并用 Hash::check 比较密码
        //$request->has('remember')
        //    检查表单中是否勾选了 “记住我”
        //    如果勾了，Laravel 会设置一个长期有效的“记住登录” cookie
        if (auth()->attempt($credentials, $request->has('remember'))) {
            if(auth()->user()->activated){
                $request->session()->regenerate();//重新生成 session ID，防止 Session Fixation 攻击（安全必做）。
                $fallback = route('users.show', auth()->user());//这 intendedLaravel 重定向器提供的方法会将用户重定向到他们之前尝试访问的 URL，
                //直到被身份验证中间件拦截。如果预期目标不可用，可以为此方法指定一个回退 URI。
                return redirect()->intended($fallback)->with('success', 'logged in successfully');
            }
            auth()->logout();
            return redirect()->route('home')->with('warning', 'Your account is not activated, please check your email.');
        }
        return back()->withInput()->with('danger', 'Invalid credentials.');
    }
        public function destroy(Request $request): RedirectResponse
    {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('login')->with('success', 'Logged out successfully.');
    }
}
