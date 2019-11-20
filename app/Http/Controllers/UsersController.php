<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //创建用户的页面
    public function create()
    {
        return view('users.create');
    }

    //显示用户个人信息的页面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //创建用户
    public function store(Request $request)
    {
        //验证用户填的信息是否符合规则
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        //验证通过 创建新用户
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        session()->flash('success', '欢迎欢迎');

        //用户创建完后重定向到个人信息页面，并把新建的用户信息传入视图
        return redirect()->route('users.show', [$user]);


    }
}
