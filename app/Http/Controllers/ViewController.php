<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Views;

class ViewController extends Controller
{
    public function view_create(Request $req) {
        if(!Views::where('user_id', '=', Auth::user()->id)->where('news_id', '=', $req->news_id)->exists()) {
        Views::create(['user_id' => Auth::user()->id, 'news_id' => $req->news_id]);
        }
    }
}
