<?php

namespace App\Observers;

use App\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TopicObserver
{
    public function saving(Topic $topic)
    {
        $excerpt = trim(preg_replace(["/\r\n/", "/\r/", "/\n/"], " ", strip_tags($topic->body)));
        $topic->excerpt = Str::limit($excerpt, 200);
    }

    public function deleted(Topic $topic)
    {
        DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}
