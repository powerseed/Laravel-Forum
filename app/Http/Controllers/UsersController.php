<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Reply;
use App\Topic;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use mysql_xdevapi\Result;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show(User $user)
    {
        $topics = Topic::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        $replies = Reply::where('user_id', $user->id)->with('topic')->orderBy('created_at', 'desc')->paginate(5);

        return view('users.show', compact('user', 'topics', 'replies'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if($request->avatar){
            $result = ImageUploadHandler::save($request->avatar, 'avatars', 416);
            if($result){
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', 'Profile updated successfully. ');
    }
}
