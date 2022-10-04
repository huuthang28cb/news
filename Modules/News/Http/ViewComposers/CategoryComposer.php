<?php

namespace Modules\News\Http\ViewComposers;

use Illuminate\View\View;
use app\Models\Categories;

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
        //dd($data_Categories);

        // get topic

        // get day
        $date = date('Y-m-d H:i:s');

        //dd($data_Categories);
        $view->with('data_Categories', $data_Categories)
                ->with('date', $date);
    }
}
