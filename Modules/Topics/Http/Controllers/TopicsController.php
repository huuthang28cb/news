<?php

namespace Modules\Topics\Http\Controllers;

use Modules\Topics\Http\Components\SelectCategories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Categories;
use App\Models\Topics;
use GuzzleHttp\Promise\Create;
use Modules\Topics\Http\Requests\CreateTopicsRequest;
use Modules\Topics\Http\Requests\UpdateTopicsRequest;
use Illuminate\Support\Facades\Log;

class TopicsController extends Controller
{
    private $categories;
    private $topics;
    public function __construct(Categories $categories, Topics $topics)
    {
        $this->categories=$categories;
        $this->topics=$topics;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $dataTopics = $this->topics->latest()->paginate(10);
        return view('topics::index', compact('dataTopics'));
    }

    public function getCategories($categoriesId)
    {
        $data= $this->categories->all();
        $options = new SelectCategories($data);
        $htmlSelect = $options->categoriesSelect($categoriesId);
        return $htmlSelect;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $htmlSelect = $this->get($categoriesId = '');
        return view('topics::create', compact('htmlSelect'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreateTopicsRequest $request)
    {
        // call model and create
        $this->topics->create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'enable'=>$request->enable,
        ]);
        return redirect()->route('topics.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('topics::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $dataTopic = $this->topics->find($id);
        $htmlSelect = $this->getCategoriesUpdate($dataTopic->id);
        return view('topics::edit', compact('dataTopic', 'htmlSelect'));
    }

    public function getCategoriesUpdate($categoriesId)
    {
        $data= $this->categories->all();
        $options = new SelectCategories($data);
        $htmlSelect = $options->categoriesSelectUpdate($categoriesId);
        return $htmlSelect;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateTopicsRequest $request, $id)
    {
        $this->topics->find($id)->update([
            'name' => $request->name,
            'category_id'=> $request->category_id,
            'enable' => $request->enable,
        ]);
        return redirect()->route('topics.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->topics->find($id)->delete();
        return redirect()->route('topics.index');
    }
}
