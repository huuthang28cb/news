<?php

namespace Modules\Posts\Http\Controllers;

use App\Models\Posts;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Topics;
use Modules\Posts\Http\Components\SelectTopics;
use Modules\Posts\Http\Requests\CreatePostRequest;
use Illuminate\Support\Facades\Http;
use DOMDocument;

class PostsController extends Controller
{
    private $topics;
    private $posts;
    public function __construct(Topics $topics, Posts $posts){
        $this->topics=$topics;
        $this->posts=$posts;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $dataPosts = $this->posts->all();
        return view('posts::index', compact('dataPosts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $htmlSelect=$this->getTopics($topicId='');
        return view('posts::create', compact('htmlSelect'));
    }

    public function getTopics($topicId){
        $data=$this->topics->all();
        $options = new SelectTopics($data);
        $htmlSelect=$options->topicsSelect();
        return $htmlSelect;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CreatePostRequest $request)
    {
        $dataPostCreate = [
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'topic_id'=>$request->topic_id,
            'post_type'=>$request->type,
            'user_id'=>$request->user_id,
            'enable'=>$request->enable
        ];
        // dd($dataPostCreate);
        $this->posts->create($dataPostCreate);
        return redirect()->route('posts.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('posts::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $dataPost = $this->posts->find($id);
        $htmlSelect=$this->getTopicsUpdate($dataPost->id);
        return view('posts::edit', compact('htmlSelect', 'dataPost'));
    }

    public function getTopicsUpdate($topicId){
        $data=$this->topics->all();
        $options = new SelectTopics($data);
        $htmlSelect=$options->topicsSelectUpdate($topicId);
        return $htmlSelect;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $dataPostUpdate = [
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'topic_id'=>$request->topic_id,
            'user_id'=>$request->user_id,
            'enable'=>$request->enable
        ];
        // dd($dataPostCreate);
        $this->posts->find($id)->update($dataPostUpdate);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->posts->find($id)->delete();
        return redirect()->route('posts.index');
    }

    public function getApi(){
        // $api = "https://infonet.vietnamnet.vn/rss/doi-song.rss";
        // $response = Http::get($api);
        // $data = $response->body();

        // dd($data);

        $feed = new DOMDocument();
            $feed->load('RSS Feed Url');
            $json = array();

            $json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
            $json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
            $json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue;

            $items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');

            $json['item'] = array();
            $i = 0;


            foreach($items as $item) {

            $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
            $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
            $purchaseurl = $item->getElementsByTagName('purchaseurl')->item(0)->firstChild->nodeValue;
            $standardimage = $item->getElementsByTagName('standardimage')->item(0)->firstChild->nodeValue;
            $shipping =      $item->getElementsByTagName('shipping')->item(0)->firstChild->nodeValue;
            $price =         $item->getElementsByTagName('price')->item(0)->firstChild->nodeValue;
            $condition  =    $item->getElementsByTagName('condition')->item(0)->firstChild->nodeValue;
            $guid = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue;


            $json['item'][$i++]['title'] = $title;
            $json['item'][$i++]['description'] = $description;
            $json['item'][$i++]['purchaseurl'] = $purchaseurl;
            $json['item'][$i++]['image'] = $standardimage;
            $json['item'][$i++]['shipping'] = $shipping;
            $json['item'][$i++]['price'] = $price;
            $json['item'][$i++]['type'] = $condition;
            $json['item'][$i++]['guid'] = $guid;  

            }


echo json_encode($json);

    }
}
