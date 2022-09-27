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

    function Parse($url){
        $simpleXml = simplexml_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($simpleXml);
        return $json;
    }

    public function getApi(Request $request){
        $url = "https://newsapi.org/v2/everything?q=tesla&from=2022-08-27&sortBy=publishedAt&apiKey=87384f1c2fe94e11a76b2f6ff11b337f";

        $data = Http::get($url);

        $item = json_decode($data->body());

        $i = collect($item->articles);

        $limit = $i->take(5);   // take limited 5 items

        $decode = json_decode($limit);

        foreach($decode as $post){
            $ite = (array)$post;
            // create post
            $dataPost = [
                'title'=>$ite['title'],
                'description'=>$ite['description'],
                'content'=>$ite['content'],
                'topic_id'=>'1',
                'post_type'=>$request->type,
                'user_id'=>'1',
                'enable'=>'1'
            ];
            $this->posts->create($dataPost);
        }
        return redirect()->route('posts.index');
    }
}
