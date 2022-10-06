<?php

namespace Modules\Home\Http\Controllers;

use App\Models\Categories;
use App\Models\PostViews;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    private $categories;
    private $postViews;

    public function __construct(Categories $categories, PostViews $postViews)
    {
        $this->categories = $categories;
        $this->postViews = $postViews;
    }

    public function index()
    {
        // total views
        $total_views = $this->postViews->get()->count();

        // total new views
        $new_views = $this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            ->orderBy('new_views', 'DESC')
            ->having('new_views', '=', 1)
            ->get();
        $back = $this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            ->orderBy('new_views', 'DESC')
            ->having('new_views', '>', 1)
            ->get();

        $total_new_views = json_decode(($new_views->count()) + ($back->count())); // views back are also a new view


        // total views back
        $views_back = $this->postViews
            ->selectRaw('count(post_id) as views_back')
            ->groupBy('post_id', 'ip_adress')
            ->orderBy('views_back', 'DESC')
            ->having('views_back', '>', 1)
            ->get()->first();
        //$total_views_back = json_decode($views_back);

        $total_views_back = $total_views - $total_new_views;
        //dd($total_views_back);


        // count the most viewed posts in the last 24 hours:
        $view_today = json_decode($this->postViews
            ->selectRaw('count(post_id) as today')
            // ->groupBy('post_id', 'ip_adress')
            ->where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-24 hours', time())))
            ->get()->first());

        // new views today
        $new_view_today = json_decode($this->postViews
            ->selectRaw('count(post_id) as new_views')
            ->groupBy('post_id', 'ip_adress')
            ->where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-24 hours', time())))
            ->having('new_views', '=', 1)
            ->get()->count());
        //dd($new_view_today);
        // back views today
        $view_back_today = json_decode($this->postViews
            ->selectRaw('count(post_id) as views_back')
            ->groupBy('post_id', 'ip_adress')
            ->where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-24 hours', time())))
            ->having('views_back', '>', 1)
            ->get()->count());
        //dd(($view_back_today));

        return view('home::index', compact(
            'total_views',
            'total_new_views',
            'total_views_back',
            'view_today',
            'new_view_today',
            'view_back_today'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('home::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
