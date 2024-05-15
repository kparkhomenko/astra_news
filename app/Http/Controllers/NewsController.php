<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function add(NewsRequest $req) {
        $req->file('img')->store('public/NewsImg');
        $image_name = $req->file('img')->hashName();
        if(Auth::user()->status == 'admin') {
            News::create(array_merge($req->validated(), ['user_id' => Auth::user()->id, 'title' => $req->title, 'text' => $req->text, 'img' => $image_name, 'category' => $req->category, 'status' => 'moderated']));
            $success_message = $req->session()->put('success_message', 'Новость добавлена');
            return redirect()->back()->with($success_message);            
        } else {
        News::create(array_merge($req->validated(), ['user_id' => Auth::user()->id, 'title' => $req->title, 'text' => $req->text, 'img' => $image_name, 'category' => $req->category, 'status' => 'unmoderated']));
        $success_message = $req->session()->put('success_message', 'Новость отправлена на модерацию');
        return redirect()->back()->with($success_message);
        }
    }

    public function delete_moderate(Request $req) {
        News::where('id', '=', $req->news_id)->delete();
    }

    public function moderate(Request $req) {
        News::where('id', '=', $req->news_id)->update(["status" => 'moderated']);
    }

    public function delete(Request $req) {
        News::where('id', '=', $req->news_id)->delete();

    }

    public function search(Request $req) {
        $news_search = News::where('title', 'like', '%'. $req->text .'%')->orWhere('text', 'like', '%'. $req->text .'%')->get();
        return view('searchPage', compact('news_search'));
    }
}
