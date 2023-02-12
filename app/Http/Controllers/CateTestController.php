<?php

namespace App\Http\Controllers;

use App\CateTest;
use Illuminate\Http\Request;

class CateTestController extends Controller
{
    public function getAdd()
    {
        return view('backend.categories_test.add');
    }

    public function postAdd(Request  $request)
    {
        $cate_tests = new CateTest();
        $cate_tests->name = $request->name;
        $cate_tests->description = $request->description;
        $cate_tests->save();
        return redirect()->route('categories_tests.list')->withSuccessTitle('Thêm dạng bài thi mới thành công');

    }

    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $cate_tests = CateTest::latest()->get();

        return view('backend.categories_test.list', compact('cate_tests'));
    }

    public function getEdit($id)
    {
        $cate_tests = CateTest::find($id);

        return view('backend.categories_test.edit', compact('cate_tests'));
    }

    public function postEdit(Request $request, $id)
    {
        $cate_tests = CateTest::find($id);
        $cate_tests->name = $request->name;
        $cate_tests->description = $request->description;
        $cate_tests->save();
        return redirect()->route('categories_tests.list')->withSuccessTitle('Sứa thông tin dạng bài thi thành công');
    }

    public function getdel($id)
    {
        $cate_tests = CateTest::find($id);
        $cate_tests->delete();

        return redirect()->route('categories_tests.list')->withSuccessTitle('Xóa dạng bài thi thành công');
    }
}
