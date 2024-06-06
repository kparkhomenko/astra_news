<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function send(Request $req){
        if (isset($req->news_id)) {
            if (Auth::user()->status == 'admin') {
            Comment::create(['news_id' => $req->news_id, 'user_name' => Auth::user()->name, 'user_id' => Auth::user()->id, 'text' => $req->text, 'status' => 'moderated']);    
            } else {
            Comment::create(['news_id' => $req->news_id, 'user_name' => Auth::user()->name, 'user_id' => Auth::user()->id, 'text' => $req->text, 'status' => 'unmoderated']);
            }
        } else {
            return redirect()->back();
        }
    }

    public function delete(Request $req) {
        Comment::where('id', '=', $req->comment_id)->delete();
    }

    public function moderate(Request $req) {
        Comment::where('id', '=', $req->comment_id)->update(["status" => 'moderated']);
    }

    public function get_moderate(Request $req) {
        $comments_admin = Comment::where('comments.status', '=', 'unmoderated')->join('news', 'news.id', '=', 'comments.news_id')
        ->select('news.title', 'comments.text', 'comments.created_at', 'comments.id', 'comments.status', 'comments.user_name')->latest()->get();
        return view('components.moderateComments', compact('comments_admin'));    
    }

    public function get(Request $req) {
        $comments = Comment::where('news_id', '=', $req->news_id)->where('status', '=', 'moderated')->orderBy('id', 'desc')
        ->latest()->get();
        return view('components.comments', compact('comments'));
    }
}
