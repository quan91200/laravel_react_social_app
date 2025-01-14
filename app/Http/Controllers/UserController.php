<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    // Hiển thị trang cá nhân của người dùng
    public function show($id)
    {
        $user = User::with(['posts', 'comments', 'following', 'followers'])
            ->withCount(['posts', 'comments', 'following', 'followers'])
            ->findOrFail($id);
        return inertia('User/Show', [
            'user' => new UserResource($user),
        ]);
    }
    // Trả về danh sách người dùng dạng mảng các resources
    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
    }
    public function edit(User $user, Request $request)
    {
        $user = Auth::user();
        return inertia('User/Edit', [
            'user' => new UserResource($user)
        ]);
    }
    // Cập nhật thông tin người dùng
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->update($request->validated());
        return redirect()->route('user.show', ['user' =>auth()->id()]);
    }
}
