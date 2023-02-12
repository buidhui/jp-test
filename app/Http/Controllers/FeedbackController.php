<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }
        
        $feedback = Feedback::with('user')->latest()->get();

        return view('backend.feedback.list', compact('feedback'));
    }

    public function saw($id)
    {
        $feedback = Feedback::find($id);
        $feedback->status = 1;

        $feedback->save();

        return redirect()->route('admin.feedback')->withSuccessTitle('Chỉnh sửa thành công');
    }

    public function getdel($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete($id);

        return redirect()->route('admin.feedback')->withSuccessTitle('Xóa thành công');
    }
}
