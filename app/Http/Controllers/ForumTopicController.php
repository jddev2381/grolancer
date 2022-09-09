<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumTopic;
use App\Models\ForumComment;

class ForumTopicController extends Controller
{
    

    public function index() {
        $topics = ForumTopic::orderBy('is_pinned')->orderBy('updated_at')->paginate(15);
        return view('forum.index', ['topics' => $topics]);
    }

    public function create() {
        return view('forum.create');
    }

    // Store new topic
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|string',
        ]);
        $topic = new ForumTopic();
        $topic->title = $request->input('title');
        $topic->user_id = auth()->user()->id;
        $topic->save();
        $comment = new ForumComment();
        $comment->description = $request->input('description');
        $comment->forum_topic_id = $topic->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return redirect('/forum')->with('message', 'Topic created.');
    }

}
