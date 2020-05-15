<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function store(ReplyRequest $request, Reply $reply)
    {
        $reply->content = $request->input('content');
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->route('topics.show', ['topic' => $reply->topic, 'previous_url' => $request->previous_url]);
    }

    public function destroy(Request $request, Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();

        return redirect()->route('topics.show', ['topic' => $reply->topic, 'previous_url' => $request->previous_url]);
    }
}
