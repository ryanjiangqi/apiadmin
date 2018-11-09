<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Validator;

class ArticleController extends Controller
{
    public function detail(Request $request)
    {
        $selectWord = $request->input('select_word');
        $list = Article::where('name', 'like', '%' . $selectWord . '%')->paginate(15);
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
        $article = Article::find($id);
        $article->name = $name;
        $article->author = $author;
        $article->status = $status;
        $article->type = $type;
        $article->keyword = $keyword;
        $article->content = $content;
        $article->save();
        return success();
    }

    public function deleted(Request $request)
    {
        $request->validate(['id' => 'required']);
        $id = $request->input('id');
        Article::where(['id' => $id])->update(['deleted_at' => date('Y-m-d H:i:s')]);
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
        return success();
    }

}