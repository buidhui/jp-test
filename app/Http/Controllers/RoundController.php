<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoundRequest;
use Illuminate\Http\Request;
use App\Round;

class RoundController extends Controller
{
    public function getAdd()
    {
        if (session('error_title')) {
            toast(session('error_title'), 'error');
        }

        return view("backend.round.add");
    }

    public function postAdd(Request $request)
    {
        $isset_round = Round::where('name', $request->name)->where('level', $request->level)->count();
        if ($isset_round > 0)
        {
            return redirect()->back()->withErrorTitle('Vòng thi đã tồn tại trong hệ thống');

        } else {
            $round = new Round();
            $round->name = $request->name;
            $round->starting_time = $request->starting_time;
            $round->level = $request->level;
            $round->save();
            
            return redirect()->route('round.list')->withSuccessTitle('Thêm vòng thi mới thành công');
        }
    }

    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $round = Round::latest()->get();

        return view("backend.round.list", compact('round'));
    }

    public function getEdit($id)
    {
        $round = Round::find($id);

        return view("backend.round.edit", compact('round'));
    }

    public function postEdit(Request $request, $id)
    {
        $round = Round::find($id);
        $round->name = $request->name;
        $round->level = $request->level;
        $round->starting_time = $request->starting_time;
        $round->save();

        return redirect()->route('round.list')->withSuccessTitle('Sứa thông tin vòng thi thành công');
    }

    public function getdel($id)
    {
        $round = Round::find($id);
        $round->delete();

        return redirect()->route('round.list')->withSuccessTitle('Xóa vòng thi thành công');
    }
}
