<?php

namespace App\Http\Controllers;

use App\CateTest;
use App\Round;
use App\Teacher;
use App\Test;
use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;
use Auth;

class TestController extends Controller
{
    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $tests = Test::latest()->get();

        return view("backend.tests.list", compact('tests'));
    }

    public function getAdd()
    {
        $round = Round::all();
        $cate_tests = CateTest::all();
        $teachers = Teacher::where('status', 1)->get();

        return view("backend.tests.add", compact('round','cate_tests','teachers'));
    }

    public function postAdd(TestRequest $request)
    {
        $test = new Test();
        $test->name = $request->name;
        $test->slug = str_slug($request->name);
        $test->round_id = $request->round;
        $test->cate_test_id = $request->cate_tests;
        $test->teacher_id = $request->teachers;
        $test->number_questions = $request->number_questions;
        $test->time = $request->time;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = public_path() . '/uploads/';
            $file->move($path, $filename);
            $test->video_fix = $filename;
        }

        $test->save();

        return redirect()->route('test.list')->withSuccessTitle('Thêm bài thi mới thành công');
    }

    public function getEdit($id)
    {
        $test = Test::find($id);
        $round = Round::all();
        $cate_tests = CateTest::all();
        $teachers = Teacher::where('status', 1)->get();

        return view("backend.tests.edit", compact('test','round', 'cate_tests','teachers'));
    }

    public function postEdit(Request  $request, $id)
    {
        $test = Test::find($id);
        $test->name = $request->name;
        $test->slug = str_slug($request->name);
        $test->round_id = $request->round;
        $test->cate_test_id = $request->cate_tests;
        $test->teacher_id = $request->teachers;
        $test->number_questions = $request->number_questions;
        $test->time = $request->time;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = public_path() . '/uploads/';
            $file->move($path, $filename);
            $test->video_fix = $filename;
        }

        $test->save();

        return redirect()->route('test.list')->withSuccessTitle('Sửa thông tin bài thi thành công');
    }

    public function getdel($id)
    {
        $test = Test::find($id);
        $test->delete();

        return redirect()->route('test.list')->withSuccessTitle('Xóa bài thi thành công');
    }
}
