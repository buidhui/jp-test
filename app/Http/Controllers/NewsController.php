<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPostRequest;
use App\News;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $posts = News::orderBy('id', 'desc')->get();

        return view("backend.posts.list", compact('posts'));
    }

    public function getAdd()
    {
        $data = Category::all();

        return view("backend.posts.add", compact("data"));
    }

    public function postAdd(Request $request)
    {

        $posts = new News();
        $posts->name = $request->name;
        $posts->slug = str_slug($request->name);
        $posts->cate_id = $request->sltCate;
        $posts->content = $request->contents;

        if ($request->hasFile('images')) {
            $f = $request->file('images')->getClientOriginalName();
            $filename = time() . '_' . $f;
            $posts->images = $filename;
            $request->file('images')->move('uploads/posts/', $filename);
        }

        $posts->save();

        return redirect()->route('posts.list')->withSuccessTitle('Thêm bài viết thành công');
    }

    public function getEdit($id)
    {
        $data = Category::all();
        $post = News::find($id);

        return view("backend.posts.edit", compact("post", 'data'));
    }

    public function postEdit(Request $request, $id)
    {
        $posts = News::find($id);
        $posts->name = $request->name;
        $posts->slug = str_slug($request->name);
        $posts->cate_id = $request->sltCate;
        $posts->content = $request->contents;
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/uploads/posts/', $file_name);

            $posts->images = $file_name;
        }

        $posts->save();

        return redirect()->route('posts.list')->withSuccessTitle('Sửa bài viết thành công');
    }

    public function getdel($id)
    {
        $posts = News::find($id);
        $posts->delete($id);

        return redirect()->route('posts.list')->withSuccessTitle('Xóa bài viết thành công');
    }
}
