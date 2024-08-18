<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class UsersController extends Controller
{
    public function __construct()
    {
        // 未登录的用户可以访问个人信息页面和注册页面
        // 未登录用户访问用户编辑页面时将被重定向到登录页面
        // 已经登录的用户才可以访问个人信息编辑页面
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store']
        ]);

        // 只让未登录用户访问注册页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    /**
     * 显示用户列表
     * 显示用户注册页面
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('users.create');
    }

    /**
     * 显示用户个人信息
     *
     * @param User $user
     * @return Factory|View|Application
     * @throws AuthorizationException
     */
    public function show(User $user): Factory|View|Application
    {
        $this->authorize('update', $user);
        return view('users.show', compact('user'));
    }

     
    /**
     * 更新用户信息
     *
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws AuthorizationException
     */
    public function update(User $user, Request $request): RedirectResponse
    {
        // 使用 authorize 方法来验证用户授权策略，如果不通过则会抛出 403 异常
        // 只有当前登录的用户为被编辑用户时才能更新用户信息
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $user->id);
    }
}