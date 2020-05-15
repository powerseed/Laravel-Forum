<?php

namespace App\Http\Controllers;

use App\Category;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\TopicRequest;
use App\Reply;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $topics = Topic::withOrder($request->order)->with('user', 'category')->paginate(20);
        $params = ['order' => 'last_replied'];
        return view('topics.show', compact('topics', 'params'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('topics.create', compact('categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::user()->id;
        $topic->save();

        return redirect()->route('topics.show', $topic->id)->with('success', 'New topic created successfully. ');
    }

    public function show(Request $request, Topic $topic)
    {
        $user = User::find($topic->user_id);
        $replies = Reply::where('topic_id', $topic->id)->with('user')->orderBy('created_at', 'desc')->paginate(10);
        $previous_url = $request->previous_url;
        return view('topics.single', ['topic' => $topic, 'user' => $user, 'replies' => $replies, 'previous_url' => $previous_url]);
    }

    public function uploadImage(Request $request)
    {
        $data = [
            "success" => false,
            "msg" => 'Upload failed. ',
            "file_path" => ''
        ];

        if($file = $request->upload_file)
        {
            $result = ImageUploadHandler::save($file, 'topics', 1024);

            if($result){
                $data['success'] = true;
                $data['msg'] = 'Upload succeeded. ';
                $data['file_path'] = $result['path'];
            }
        }

        return $data;
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);

        $categories = Category::all();
        return view('topics.edit', compact('categories', 'topic'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->title = $request->title;
        $topic->body = $request->body;
        $topic->category_id = $request->category_id;
        $topic->save();

        return redirect()->route('topics.show', $topic)->with('success', 'Topic updated successfully. ');
    }

    public function destroy(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->delete();

        return Redirect::to($request->previous_url)->with('success', 'Topic deleted successfully. ');
    }
}
