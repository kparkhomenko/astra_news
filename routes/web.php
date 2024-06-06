<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Models\User;
use App\Models\News;
use App\Models\Comment;
use App\Models\Views;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/mainpage');
});

Route::get('mainpage', function () {
    Artisan::call('storage:link');
    $last_news = News::where('status', '=', 'moderated')->orderBy('id', 'desc')->paginate(4);
    $news_sport = News::where('status', '=', 'moderated')->where('category', '=', 'Спорт')->orderBy('id', 'desc')->paginate(4);
    $news_region = News::where('status', '=', 'moderated')->where('category', '=', 'Регион')->orderBy('id', 'desc')->paginate(4);
    $news_culture = News::where('status', '=', 'moderated')->where('category', '=', 'Культура')->orderBy('id', 'desc')->paginate(2);
    $news_project = News::where('status', '=', 'moderated')->where('category', '=', 'Проекты')->orderBy('id', 'desc')->paginate(3);
    return view('mainpage', compact('news_sport', 'news_region', 'news_culture', 'news_project', 'last_news'));
})->name('mainpage');
Route::get('getId', [ViewController::class, 'view_create'])->name('getId');
Route::post('search', [NewsController::class, 'search'])->name('search');

Route::get('register', function () {
    return view('registration');
})->name('register');
Route::post('register', [userController::class, 'register'])->name('user_register');


Route::get('login', function () {
    return view('login');
})->name('login');
Route::post('login', [userController::class, 'login'])->name('user_login');

Route::get('userpage/{id}', function($id) {
    Artisan::call('storage:link');
        if(Auth::check()) {
        $user = User::find($id);
        if ($user) {
        $views_count = Views::where('user_id', '=', $id)->count();
        $news_count = News::where('user_id', '=', $id)->count();
        $comment_count = Comment::where('user_id', '=', $id)->where('status', '=', 'moderated')->count();
        if(Auth::user()->status == 'admin') {
        return view('userpage', compact('user', 'views_count', 'news_count', 'comment_count'));
        } else {
        $news = News::where('user_id', '=', $id)->where('status', '=', 'moderated')->latest()->get();
        $comments = Comment::where('comments.user_id', '=', $id)->where('comments.status', '=', 'moderated')
        ->join('news', 'news.id', '=', 'comments.news_id')
        ->select('news.title', 'comments.text', 'comments.created_at')->latest()->get();
        return view('userpage', compact('user', 'views_count', 'news_count', 'comment_count', 'news', 'comments'));
        }
        }
        else {
            return redirect('mainpage');
        }  } else {
            return redirect('mainpage');
        }
})->name('userpage');
Route::get('getModerateComments', [CommentController::class, 'get_moderate'])->name('getModerateComments');
Route::get('deleteComment', [CommentController::class, 'delete'])->name('deleteComment');
Route::get('addModerateComment', [CommentController::class, 'moderate'])->name('addModerateComment');
Route::get('deleteModerateNews', [NewsController::class, 'delete_moderate'])->name('deleteModerateNews');
Route::get('addModerateNews', [NewsController::class, 'moderate'])->name('addModerateNews');
Route::get('getModerateSportNews', [NewsController::class, 'get_sport_moderate'])->name('getModerateSportNews');
Route::get('getModerateRegionNews', [NewsController::class, 'get_region_moderate'])->name('getModerateRegionNews');
Route::get('getModerateCultureNews', [NewsController::class, 'get_culture_moderate'])->name('getModerateCultureNews');
Route::get('getModerateProjectNews', [NewsController::class, 'get_project_moderate'])->name('getModerateProjectNews');
Route::get('getSportNews', [NewsController::class, 'get_sport'])->name('getSportNews');
Route::get('getRegionNews', [NewsController::class, 'get_region'])->name('getRegionNews');
Route::get('getCultureNews', [NewsController::class, 'get_culture'])->name('getCultureNews');
Route::get('getProjectNews', [NewsController::class, 'get_project'])->name('getProjectNews');
Route::post('userpage/search', [NewsController::class, 'search']);
Route::post('news/search', [NewsController::class, 'search']);
Route::post('admin/search', [NewsController::class, 'search']);

Route::get('admin/news', function() {
    if(Auth::check()){
        if(Auth::user()->status == 'admin') {
            return view('admin');
        } else {
            return redirect('mainpage');          
        }
    } else {
        return redirect('mainpage');
    }
})->name('admin_news');
Route::get('deleteNews', [NewsController::class, 'delete'])->name('deleteNews');

Route::get('update', function() {
    if(Auth::check()) {
        $user = User::find(Auth::user()->id);
        return view('update', compact('user'));
    }
    else {
        return redirect('mainpage');
    }
})->name('update');
Route::post('update_user', [userController::class, 'update'])->name('update_user');
Route::post('password_change', [userController::class, 'password_change'])->name('password_change');

Route::get('news/{id}', function($id) {
    $news_item = News::find($id);
    if(isset($news_item)) {
    $last_news = News::orderBy('id', 'desc')->where('status', '=', 'moderated')->paginate(4);
    if($news_item->status == 'unmoderated') {
        if(Auth::check()) {
        if(Auth::user()->status == 'admin') {
            return view('newsPage', compact('news_item', 'last_news'));
        } else {
            return redirect('mainpage');
        } }
        else {
            return redirect('mainpage');
        }
    } else {
        return view('newsPage', compact('news_item', 'last_news'));
    }
    } else {
        return redirect('mainpage');
    }
});
Route::get('sendcomment', [CommentController::class, 'send'])->name('sendComment');
Route::get('getComments', [CommentController::class, 'get'])->name('getComments');

Route::get('logout', function () {
    Auth::logout();
    return redirect('mainpage');
})->name('logout');

Route::get('upload', function () {
    if(Auth::check()) {
        return view('newsUpload');
    }
    else {
        return redirect('mainpage');
    }
})->name('upload');
Route::post('upload', [NewsController::class, 'add'])->name('add');

Route::get('sport', function() {
    $category_name = 'Спорт';
    $news = News::where('status', '=', 'moderated')->where('category', '=', 'Спорт')->get();
    $last_news = News::where('status', '=', 'moderated')->latest()->paginate(4);
    return view('newsList', compact('news', 'last_news', 'category_name'));
})->name('sport');

Route::get('region', function() {
    $category_name = 'Регион';
    $news = News::where('status', '=', 'moderated')->where('category', '=', 'Регион')->get();
    $last_news = News::where('status', '=', 'moderated')->latest()->paginate(4);
    return view('newsList', compact('news', 'last_news', 'category_name'));
})->name('region');

Route::get('culture', function() {
    $category_name = 'Культура';
    $news = News::where('status', '=', 'moderated')->where('category', '=', 'Культура')->get();
    $last_news = News::where('status', '=', 'moderated')->latest()->paginate(4);
    return view('newsList', compact('news', 'last_news', 'category_name'));
})->name('culture');

Route::get('project', function() {
    $category_name = 'Проекты';
    $news = News::where('status', '=', 'moderated')->where('category', '=', 'Проекты')->get();
    $last_news = News::where('status', '=', 'moderated')->latest()->paginate(4);
    return view('newsList', compact('news', 'last_news', 'category_name'));
})->name('project');

