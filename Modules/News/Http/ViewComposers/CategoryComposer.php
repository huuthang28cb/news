<?php

namespace Modules\News\Http\ViewComposers;
use Illuminate\View\View;
use app\Models\Categories;

class CategoryComposer
{
    public function compose(View $view){
        // get all category
        $data_Categories = json_decode(Categories::all());
        
        //dd($data_Categories);
        $view->with('data_Categories', $data_Categories);
    }
}