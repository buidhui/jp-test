<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{
    public function index()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $users = User::latest()->get();

        return view('backend.users.list', compact('users'));
    }

    public function getdel($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.list')->withSuccessTitle('Xóa học viên thành công');
    }

    public function getAdd()
    {
        return view("backend.users.add");
    }

    public function postAdd(AddUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;
        $user->sex = $request->sex;
        $user->level = $request->level;
        $user->password = Hash::make(123456);
        $user->save();

        return redirect()->route('users.list')->withSuccessTitle('Thêm học viên mới thành công');
    }
}
