<?php

namespace Modules\News\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
    private $categories;
    private $posts;
    public function __construct(Categories $categories, Posts $posts)
    {
        $this->categories = $categories;
        $this->posts = $posts;
    }
    public function index()
    {
        // Công nghệ
        $tech = json_decode($this->posts->where('topic_id', 4)->latest()->first());
        // Giải trí
        $ent = json_decode($this->posts->where('topic_id', 1)->latest()->first());
        // Thời sự
        $new = json_decode($this->posts->where('topic_id', 6)->latest()->first());

        $first_post = $this->posts->latest()->first();
        $posts_data = $this->posts->latest()->skip(0)->take(5)->get(); //get first 5 rows and latest
        //dd(json_decode($posts_data));
        return view('news::index', compact(
            'posts_data',
            'first_post',
            'tech',
            'ent',
            'new'
        ));
    }


    public function create()
    {
        return view('news::create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('news::show');
    }


    public function edit($id)
    {
        return view('news::edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
