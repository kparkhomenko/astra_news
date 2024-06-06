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

    public function get_sport_moderate(Request $req) {
        $news_sport = News::where('category', '=', 'Спорт')->where('status', '=', 'unmoderated')->latest()->get();
        return view('components.adminNews.newsModerateSport', compact('news_sport'));
    }

    public function get_region_moderate(Request $req) {
        $news_region = News::where('category', '=', 'Регион')->where('status', '=', 'unmoderated')->latest()->get();
        return view('components.adminNews.newsModerateRegion', compact('news_region'));
    }

    public function get_culture_moderate(Request $req) {
        $news_culture = News::where('category', '=', 'Культура')->where('status', '=', 'unmoderated')->latest()->get();
        return view('components.adminNews.newsModerateCulture', compact('news_culture'));
    }

    public function get_project_moderate(Request $req) {
        $news_project = News::where('category', '=', 'Проекты')->where('status', '=', 'unmoderated')->latest()->get();
        return view('components.adminNews.newsModerateProject', compact('news_project'));
    }

    public function get_sport(Request $req) {
        $news_sport = News::where('category', '=', 'Спорт')->where('status', '=', 'moderated')->latest()->get();
        return view('components.adminNews.newsSport', compact('news_sport'));
    }

    public function get_region(Request $req) {
        $news_region = News::where('category', '=', 'Регион')->where('status', '=', 'moderated')->latest()->get();
        return view('components.adminNews.newsRegion', compact('news_region'));
    }

    public function get_culture(Request $req) {
        $news_culture = News::where('category', '=', 'Культура')->where('status', '=', 'moderated')->latest()->get();
        return view('components.adminNews.newsCulture', compact('news_culture'));
    }

    public function get_project(Request $req) {
        $news_project = News::where('category', '=', 'Проекты')->where('status', '=', 'moderated')->latest()->get();
        return view('components.adminNews.newsProject', compact('news_project'));
    }
}
