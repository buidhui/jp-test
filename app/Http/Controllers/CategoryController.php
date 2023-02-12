<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $categories = Category::orderBy('id','desc')->get();

        return view("backend.categories.list", compact('categories'));
    }

    public function getAdd()
    {
        return view("backend.categories.add");
    }

    public function postAdd(Request  $request)
    {
        $cate = new Category();
        $cate->name = $request->name;
        $cate->slug = str_slug($request->name);
        $cate->save();

        return redirect()->route('categories.list')->withSuccessTitle('Thêm thể loại bài viết thành công');
    }

    public function getEdit($id)
    {
        $categories = Category::find($id);

        return view("backend.categories.edit", compact('categories'));
    }

    public function postEdit(Request  $request, $id)
    {
        $cate = Category::find($id);
        $cate->name = $request->name;
        $cate->slug = str_slug($request->name);
        $cate->save();

        return redirect()->route('categories.list')->withSuccessTitle('Sửa thể loại bài viết thành công');
    }

    public function getdel($id)
    {
        $cate = Category::find($id);
        $cate->delete();

        return redirect()->route('categories.list')->withSuccessTitle('Xóa thể loại bài viết thành công');
    }
}
