<?php

namespace App\Http\Controllers;

use App\Image;
use App\News;
use Illuminate\Http\Request;
use App\User;
use Session;
use Verta;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $news_latest = DB::table('news')
        ->orderBy('id', 'desc')
        ->select('id', 'title', 'time_added','view')
        ->limit(8)
        ->get();
        foreach ($news_latest as $key => $order) {
            $v = Verta::createTimestamp((int) $news_latest[$key]->time_added);
            $news_latest[$key]->time_added = $v->formatDifference();
        }
        return view('index',['news_latest'=>$news_latest]);
    }


    public function home()
    {
        return view('home');
    }


    public function getuser()
    {
        $username = Session::get('username');
        $user = User::where('username', $username)->first();
        return $user;
    }


    public function contact()
    {
        return view('pages.contact');
    }


    public function about()
    {
        return view('pages.about');
    }

    public function news()
    {
        $news_viewed = DB::table('news')
            ->orderBy('news.view', 'desc')
            ->leftJoin('image', 'news.id', '=', 'image.refrence_id')
            ->where('image.type', '2')
            ->select('news.id', 'news.title', 'news.time_added','news.view', 'image.img')
            ->limit(8)
            ->get();
        // $news_latest = News::orderBy('id', 'desc')->limit(16)->get();
        $news_latest = DB::table('news')
            ->orderBy('news.id', 'desc')
            ->leftJoin('image', 'news.id', '=', 'image.refrence_id')
            ->where('image.type', '2')
            ->select('news.id', 'news.title', 'news.time_added','news.view', 'image.img')
            ->limit(16)
            ->get();

        foreach ($news_viewed as $key => $order) {
            $v = Verta::createTimestamp((int) $news_viewed[$key]->time_added);
            $news_viewed[$key]->time_added = $v->formatDifference();
        }
        foreach ($news_latest as $key => $order) {
            $v = Verta::createTimestamp((int) $news_latest[$key]->time_added);
            $news_latest[$key]->time_added = $v->formatDifference();
        }


        return view('pages.news', ['news_latest' => $news_latest, 'news_viewed' => $news_viewed]);
    }


    public function singlenews($id)
    {

        $news = News::where('id', $id)->first();

        $img = Image::where('refrence_id', $id)->where('type', 2)->first();

        // added to view
        $update = News::where('id',$id)->update([
            'view'=>$news->view + 1
        ]);
        $news->view += 1;


        $v = Verta::createTimestamp((int) $news->time_added);
        $news->time_added = $v->formatDifference();


        return view('pages.singlenews', ['news' => $news,'img'=>$img]);
    }

}
