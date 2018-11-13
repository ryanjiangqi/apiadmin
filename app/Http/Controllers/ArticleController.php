<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\ArticleImages;
use App\Models\FileResource;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function detail(Request $request)
    {
        $selectWord = $request->input('select_word');
        $list = Article::where('name', 'like', '%' . $selectWord . '%')->with('articleImages')->OrderBy('id', 'DESC')->paginate(15);

        return success($list);
    }

    private function validateArticle($request)
    {
        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'status' => 'required',
            'type' => 'required',
            'keyword' => 'required',
            'content' => 'required'
        ]);
    }

    public function update(Request $request)
    {
        $this->validateArticle($request);
        $id = $request->input('id');
        $name = $request->input('name');
        $author = $request->input('author');
        $status = $request->input('status');
        $type = $request->input('type');
        $keyword = $request->input('keyword');
        $content = $request->input('content');
        $image = $request->input('image');
        $article = Article::find($id);
        $article->name = $name;
        $article->author = $author;
        $article->status = $status;
        $article->type = $type;
        $article->keyword = $keyword;
        $article->content = $content;
        $article->save();
        ArticleImages::where(['article_id' => $id])->delete();
        if (!empty($image)) {
            foreach ($image as $key => $item) {
                $data[$key]['article_id'] = $article->id;
                $data[$key]['image'] = $item;
                $data[$key]['created_at'] = date('Y-m-d H:i:s');
                $data[$key]['updated_at'] = date('Y-m-d H:i:s');
            }
            ArticleImages::insert($data);
        }
        return success();
    }

    public function deleted(Request $request)
    {
        $request->validate(['id' => 'required']);
        $id = $request->input('id');
        Article::where(['id' => $id])->update(['deleted_at' => date('Y-m-d H:i:s')]);
        ArticleImages::where(['article_id' => $id])->delete();
        return success();
    }

    public function addSave(Request $request)
    {
        $this->validateArticle($request);
        $name = $request->input('name');
        $author = $request->input('author');
        $status = $request->input('status');
        $type = $request->input('type');
        $keyword = $request->input('keyword');
        $content = $request->input('content');
        $image = $request->input('image');
        $article = new Article();
        $article->name = $name;
        $article->author = $author;
        $article->status = $status;
        $article->type = $type;
        $article->keyword = $keyword;
        $article->content = $content;
        $article->created_at = date('Y-m-d H:i:s');
        $article->updated_at = date('Y-m-d H:i:s');
        $article->save();
        if (!empty($image)) {
            foreach ($image as $key => $item) {
                $data[$key]['article_id'] = $article->id;
                $data[$key]['image'] = $item;
                $data[$key]['created_at'] = date('Y-m-d H:i:s');
                $data[$key]['updated_at'] = date('Y-m-d H:i:s');
            }
            ArticleImages::insert($data);
        }
        return success();
    }

    public function uploadImage(Request $request, FileResource $fileResource)
    {
        $request->validate(['file' => 'required']);
        $image = $request->file('file');
        $path = Storage::putFile('public', $image);
        $pathArray = explode('/', $path);
        $fileResource->old_name = $image->getClientOriginalName();
        $fileResource->new_name = $path;
        $fileResource->created_at = date('Y-m-d H:i:s');
        $fileResource->save();
        return success($pathArray[1]);
    }

    public function uploadImageEditor(Request $request, FileResource $fileResource)
    {
        $request->validate(['file' => 'required']);
        $image = $request->file('file');
        $path = Storage::putFile('public', $image);
        $pathArray = explode('/', $path);
        $fileResource->old_name = $image->getClientOriginalName();
        $fileResource->new_name = $path;
        $fileResource->created_at = date('Y-m-d H:i:s');
        $fileResource->save();
        return success(config('app.url') . '/storage/' . $pathArray[1]);
    }

    public function aboutUs()
    {
        $data = About::first();
        return success($data);
    }

    public function editAbout(Request $request)
    {
        $content = $request->input('content');
        $data = About::first();
        $data->content = $content;
        $data->save();
        return success();
    }


}