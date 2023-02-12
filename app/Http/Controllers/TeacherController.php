<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationTeacher;
use App\Teacher;
use App\Test;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class TeacherController extends Controller
{
    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $teachers = Teacher::latest()->get();

        return view('backend.teachers.list', compact('teachers'));
    }

    public function Approval($id)
    {
        $teachers = Teacher::find($id);
        $teachers->status = 1;
        $teachers->save();

        return redirect()->route('teachers.list')->withSuccessTitle('Duyệt giáo viên mới thành công');
    }

    public function getdel($id)
    {
        $teachers = Teacher::find($id);
        $teachers->delete();

        return redirect()->route('teachers.list')->withSuccessTitle('Xóa giáo viên thành công');
    }

    public function getAdd()
    {
        return view('backend.teachers.add');
    }

    public function postAdd(RegistrationTeacher $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make(123456);
        $teacher->date_of_birth = $request->birthday;
        $teacher->phone = $request->phone;
        $teacher->sex = $request->sex;
        if ($request->hasFile('cv')) {
            $f = $request->file('cv')->getClientOriginalName();
            $filename = time() . '_' . $f;
            $teacher->cv = $filename;
            $request->file('cv')->move('uploads/cv/', $filename);
        }
        $teacher->save();

        return redirect()->route('teachers.list')->withSuccessTitle('Thêm giáo viên mới thành công');
    }

    public function dasboard()
    {
        return view('backend.dashboard');
    }

    public function getTestListByTeacher()
    {
        $id = Auth::guard('teachers')->user()->id;
        $tests = Test::where('teacher_id', $id)->latest()->get();
        
        return view("backend.tests.list-test-teacher", compact('tests'));
    }
}
