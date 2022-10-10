<?php

namespace Modules\Home\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Posts;

class PostsComposer
{
    private $posts;
    public function __construct(Posts $posts)
    {
        $this->posts = $posts;
    }
    public function compose(View $view)
    {
        dd('skhskdfhskd');

        // get all category
        $data_posts = json_decode($this->posts->where('enable', 0)->get());
        //dd($data_posts);

        // get topic


        //dd($data_Categories);
        $view->with('data_posts', $data_posts);
    }
}
