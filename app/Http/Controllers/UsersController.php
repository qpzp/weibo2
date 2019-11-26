<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Mail;

class UsersController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth', [
      'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
    ]);
    $this->middleware('guest', [
      'only' => ['create']
    ]);
  }

  //用户列表
  public function index()
  {
    $users = User::paginate(10);
    return view('users.index', compact('users'));
  }

  //创建用户的页面
  public function create()
  {
    return view('users.create');
  }

  //显示用户个人信息的页面
  public function show(User $user)
  {
    $statuses = $user->statuses()
      ->orderBy('created_at', 'desc')
      ->paginate(10);
    return view('users.show', compact('user', 'statuses'));
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

    $this->sendEmailConfirmationTo($user);

    session()->flash('success', '验证邮箱已发送到您的邮箱，请注意查收');

    //用户创建完后重定向到个人信息页面，并把新建的用户信息传入视图
//        return redirect()->route('users.show', [$user]);
    return redirect('/');
  }

  protected function sendEmailConfirmationTo($user)
  {
    $view = 'emails.confirm';
    $data = compact('user');
    $to = $user->email;
    $subject = '感谢注册，请确认你的邮箱';

    Mail::send($view, $data, function ($message) use ($to, $subject) {
      $message->to($to)->subject($subject);
    });
  }

  //编辑资料页面
  public function edit(User $user)
  {
    $this->authorize('update', $user);
    return view('users.edit', compact('user'));
  }

  //更新资料
  public function update(User $user, Request $request)
  {
    $this->authorize('update', $user);
    $this->validate($request, [
      'name' => 'required|max:50',
      'password' => 'nullable|confirmed|min:6'
    ]);

    $data = [];
    $data['name'] = $request['name'];
    if ($request->password) {
      $data['password'] = bcrypt($request->password);
    }
    $user->update($data);

    session()->flash('success', '个人资料更新成功');

//        $user->update([
//            'name' => $request->name,
//            'password' => $request->bcrypt($request->password)
//        ]);

    return redirect()->route('users.show', $user->id);
  }

  //g管理员删除用户
  public function destroy(User $user)
  {
    $this->authorize('destroy', $user);
    $user->delete();
    session()->flash('success', '成功删除用户');
    return back();
  }

  public function confirmEmail($token)
  {
    $user = User::where('activation_token', $token)->firstOrFail();
    $user->activated = true;
    $user->activation_token = null;
    $user->save();

    Auth::login($user);
    session()->flash('success', '恭喜你，激活成功！');
    return redirect()->route('users.show', [$user]);
  }

  //关注视图
  public function followings(User $user)
  {
    $users = $user->followings()->paginate();
    $title = $user->name . '关注的人';
    return view('users.show_follow', compact('users', 'title'));

  }

  //粉丝视图
  public function followers(User $user)
  {
    $users = $user->followers()->paginate(30);
    $title = $user->name . '的粉丝';
    return view('users.show_follow', compact('users', 'title'));
  }
}
