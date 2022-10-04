<?php

namespace Modules\News\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use App\Models\PostViews;
use App\Models\Topics;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
    private $topics;
    private $categories;
    private $posts;
    public function __construct(Topics $topics, Posts $posts, Categories $categories)
    {
        $this->topics = $topics;
        $this->posts = $posts;
        $this->categories = $categories;
    }
    public function index()
    {
        // Công nghệ
        $tech = json_decode($this->posts->with('topics')->where('topic_id', 4)->latest()->first());
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


    public function detail($slug)
    {
        //$this->posts->postviews()->attach($tagIds);
        $posts_data = $this->posts->latest()->skip(0)->take(10)->get(); //get first 5 rows and latest
        $detail = json_decode($this->posts->with('topics')->where('slug', $slug)->first());
        return view('news::detail', compact('detail', 'posts_data'));
    }


    public function categories($slug)
    {
        $topics_data = json_decode($this->categories->with('topics')->where('slug', $slug)->first());
        $categories_data = $this->categories->with('postss')->where('slug', $slug)->first();
        //dd(json_decode($categories_data));
        return view('news::categories', compact('categories_data', 'topics_data'));
    }


    public function topics($slug)
    {
        $list_topic = json_decode($this->topics->with('categories')->where('slug', $slug)->first()); // list các topic theo slug
        $name = $list_topic->categories; // get name of categories
        //dd($name);

        $topics_data = json_decode($this->categories->with('topics')->where('slug', $name->slug)->first()); // get list topic with categories slug
        //dd($topics_data);

        $categories_data = json_decode($this->topics->with('postss')->where('slug', $slug)->first()); //cate có nhiều posts
        //dd($categories_data);
        return view('news::topics', compact('categories_data', 'topics_data', 'name'));
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
