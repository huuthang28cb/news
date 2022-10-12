<?php

namespace Modules\News\Http\ViewComposers;

use Illuminate\View\View;
use app\Models\Categories;
use App\Models\Posts;
use \Auth;

class CategoryComposer
{
    private $categories;
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }
    public function compose(View $view)
    {
        // get all category
        $auth_id = Auth::user()->id;
        $data_Categories = json_decode($this->categories->with('topics')->get());
        $post_disable = json_decode(Posts::where('enable', 0)->with('post_user')->with('post_check')->get());
        //dd($post_disable);
        $checked_posts = json_decode(
            Posts::where('enable', 0)
                ->with('post_user')
                ->where('user_id', $auth_id)
                ->with('post_check')
                ->get()
        );
        // foreach($checked_posts as $t){
        //     $g = array_merge($t['post_user'], $t['post_check']);
        // }
        //dd($checked_posts);

        // get topic

        // get day
        $date = date('Y-m-d H:i:s');

        //dd($data_Categories);
        $view->with('data_Categories', $data_Categories)
            ->with('date', $date)
            ->with('post_disable', $post_disable)
            ->with('checked_posts', $checked_posts);
    }
}
