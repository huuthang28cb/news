<?php

namespace Modules\News\Http\ViewComposers;

use Illuminate\View\View;
use app\Models\Categories;
use App\Models\Posts;

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
        $data_Categories = json_decode($this->categories->with('topics')->get());
        $post_disable = json_decode(Posts::where('enable', 0)->with('post_user')->get());
        //dd($post_disable);

        // get topic

        // get day
        $date = date('Y-m-d H:i:s');

        //dd($data_Categories);
        $view->with('data_Categories', $data_Categories)
                ->with('date', $date)
                ->with('post_disable', $post_disable);
    }
}
