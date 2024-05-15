<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function send(Request $req){
        if (isset($req->news_id)) {
            Comment::create(['news_id' => $req->news_id, 'user_name' => Auth::user()->name, 'user_id' => Auth::user()->id, 'text' => $req->text]);
            $success_message = $req->session()->put('success_message', 'Комментарий добавлен');
            return redirect()->back()->with($success_message);
        } else {
            return redirect()->back();
        }
    }

    public function delete(Request $req) {
        Comment::where('id', '=', $req->comment_id)->delete();
    }
}
