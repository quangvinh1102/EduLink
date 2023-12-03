<?php

namespace App\Http\Controllers;

use App\Http\Services\FileService;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    protected $file;
    public function __construct(FileService $file)
    {
        $this->file = $file;
    }
    public function store(Request $request){
        // dd($request->all());
        if ($request->hasFile('img')) {
            $nameFile = $request->img->getClientOriginalName();
            $path = $this->file->uploadImage($request->img, 'articles', $nameFile);
        }
        try {
            $create = Articles::create([
                'content' => $request->content,
                'img' => $path,
                'user_id' => $request->user_id,
            ]);

            return response()->json(['mess' => 'Tạo bài viết thành công']);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function index() {
        $articles = Articles::with('user')->get()->toArray();
        foreach ($articles as &$item) {
            $item['img'] = Storage::url($item['img']);
            $item['user']['avatar'] = Storage::url($item['user']['avatar']);
        }
        $articles = array_reverse($articles);
        return response()->json($articles);
    }

    public function delete($id) {
        $article = Articles::find($id);
        try {
            $article->delete();

            return response()->json(['mess' => 'Xóa thành công!!']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function edit($id) {
        $article = Articles::find($id);
        $article['img'] = Storage::url($article['img']);
        return response()->json(['article' => $article]);
    }

    public function update(Request $request, $id) {
        $article = Articles::find($id);

        if ($request->hasFile('img')) {
            if (Storage::exists($article->img)) {
                Storage::delete($article->img);
                // dd($user->avatar);
            }
            $nameFile = $request->img->getClientOriginalName();
            $path = $this->file->uploadImage($request->img, 'img', $nameFile);
            // dd($path);
        } else {
            $path = $article->img;
        }

        try {
            $article->update([
                'content' => $request->content,
                'img' => $path,
            ]);
            return response()->json(['mess' => 'Cập nhật ảnh thành công!']);
        } catch (\Exception $e) {
            dd($e);
        }

    }

}
