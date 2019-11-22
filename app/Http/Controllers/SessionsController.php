<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    //显示登录页面视图
    public function create()
    {
        return view('sessions.create');
    }

    //登录
    public function store(Request $request)
    {
        //验证数据是否符合规则
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|'
        ]);

        //如果数据存在数据库中
        if (Auth::attempt($credentials, $request->has('remember'))) {
            session()->flash('success', '欢迎回来');
            $fallback = route('users.show', [Auth::user()]);
            return redirect()->intended($fallback);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();

        }
    }

    //退出
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出');
        return redirect('login');
    }
}
