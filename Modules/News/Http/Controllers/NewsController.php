<?php

namespace Modules\News\Http\Controllers;

use App\Models\Categories;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
    private $categories;
    public function __construct(Categories $categories)
    {
        $this->categories=$categories;
    }
    public function index()
    {
        $cate_data = $this->categories->all();
        return view('news::index', compact('cate_data'));
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
