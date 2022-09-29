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
use Modules\Posts\Http\Traits\StorageImageTrait;

class PostsController extends Controller
{
    use StorageImageTrait;
    private $topics;
    private $posts;
    public function __construct(Topics $topics, Posts $posts)
    {
        $this->topics = $topics;
        $this->posts = $posts;
    }

    public function index()
    {
        $dataPosts = $this->posts->all();
        return view('posts::index', compact('dataPosts'));
    }

    public function create()
    {
        $htmlSelect = $this->getTopics($topicId = '');
        return view('posts::create', compact('htmlSelect'));
    }

    public function getTopics($topicId)
    {
        $data = $this->topics->all();
        $options = new SelectTopics($data);
        $htmlSelect = $options->topicsSelect();
        return $htmlSelect;
    }

    public function store(CreatePostRequest $request)
    {
        $dataPostCreate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'post_type' => $request->type,
            'user_id' => $request->user_id,
            'enable' => $request->enable
        ];

        // data image upload
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'posts');

        // nếu image upload is not empty
        if (!empty($dataUploadFeatureImage)) {
            $dataPostCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataPostCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        // dd($dataPostCreate);
        $this->posts->create($dataPostCreate);
        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        return view('posts::show');
    }

    public function edit($id)
    {
        $dataPost = $this->posts->find($id);
        $dataTopic = $this->topics->all();
        //$htmlSelect=$this->getTopicsUpdate($dataPost->id);
        return view('posts::edit', compact('dataTopic', 'dataPost'));
    }

    public function getTopicsUpdate($topicId)
    {
        $data = $this->topics->all();
        $options = new SelectTopics($data);
        $htmlSelect = $options->topicsSelectUpdate($topicId);
        return $htmlSelect;
    }

    public function update(Request $request, $id)
    {
        $dataPostUpdate = [
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'topic_id' => $request->topic_id,
            'user_id' => $request->user_id,
            'enable' => $request->enable
        ];
        // data image upload
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'posts');

        // nếu image upload is not empty
        if (!empty($dataUploadFeatureImage)) {
            $dataPostUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataPostUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }

        $this->posts->find($id)->update($dataPostUpdate);
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $this->posts->find($id)->delete();
        return redirect()->route('posts.index');
    }

    // tìm title trong db->đối chứng với nhau xem có trùng nhau hay k->nếu trùng thì ko tạo->ngược lại thì tạo luôn vào database
    public function getTitle($title)
    {
        $title = $this->posts->where('title', $title)->get();
        return $title;
    }

    public function getApi(Request $request)
    {
        $url = "https://newsapi.org/v2/top-headlines?sources=techcrunch&apiKey=87384f1c2fe94e11a76b2f6ff11b337f";

        $data = Http::get($url);

        $item = json_decode($data->body());

        $i = collect($item->articles);

        $limit = $i->take(20);   // take limited 5 items

        $decode = json_decode($limit);

        foreach ($decode as $post) {
            $ite = (array)$post;

            // create post 
            $dataPost = [
                'title' => $ite['title'],
                'description' => $ite['description'],
                'content' => $ite['content'],
                'topic_id' => '1',
                'post_type' => $request->type,
                'user_id' => '1',
                'enable' => '1',
                'feature_image_path' => $ite['urlToImage']
            ];
            //dd($dataPost);
            $this->posts->firstOrCreate($dataPost);
        }
        return redirect()->route('posts.index');
    }
}
