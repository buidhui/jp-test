<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\RegistrationStudent;
use App\Http\Requests\RegistrationTeacher;
use App\News;
use App\Question;
use App\Result;
use App\Teacher;
use App\Test;
use App\User;
use App\Feedback;
use App\UserPassRound;
use App\UserQuestion;
use App\CateTest;
use App\Round;
use App\QuestionTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;
use Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class PageController extends Controller
{
    public function home()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        $dt = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
        $count_round = Round::where('level', 1)->where('starting_time', '<=', $dt->toDateString())->count();

        $last_round = Round::where('level', 1)->oldest()->skip($count_round)->first();
        $date_time_start = date('Y-m-d H:i:s', strtotime($last_round->starting_time));
        $date_time_now = date('Y-m-d H:i:s', strtotime($dt));
        $diff = strtotime($date_time_start) - strtotime($date_time_now); 
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minutes  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
        return view("frontend.pages.home", compact(['count_round', 'days', 'hours', 'minutes']));
    }

    public function getRegistrationTeacher()
    {
        return view('frontend.pages.registration_teacher');
    }

    public function postRegistrationTeacher(RegistrationTeacher $request)
    {
        $teacher = new Teacher();
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->password = Hash::make($request->password);
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

        return redirect()->route('home_page')->withSuccessTitle('Đăng ký giáo viên thành công');
    }

    public function getRegistrationStudent()
    {
        return view('frontend.pages.registration_student');
    }

    public function postRegistrationStudent(RegistrationStudent $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->date_of_birth = $request->birthday;
        $user->sex = $request->sex;
        $user->level = $request->level;
        $user->address = $request->address;
        $user->save();

        return redirect()->route('user.login')->withSuccessTitle('Đăng ký học viên thành công');
    }

    public function selfTraining()
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login');
        } else {
            $dt = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            
            $count_round = Round::where('level', 1)->where('starting_time', '<=', $dt->toDateString())->count();

            $count_pass_round = UserPassRound::where('user_id', Auth::guard('web')->user()->id)->count();
            
            if ($count_round < $count_pass_round + 1) {
                return redirect()->route('home_page')->with(['error_code' => 1]);
            } else {
                $round_pass = UserPassRound::where('user_id', Auth::guard('web')->user()->id)->get();

                $arr_pass = [];

                foreach ($round_pass as $item) {
                    $arr_pass[] = $item->round_id;               
                }                    

                $round_curent = Round::where('starting_time', '<=', $dt->toDateString())
                    ->where('level', Auth::guard('web')->user()->level)
                    ->orderBy('id', 'ASC')
                    ->whereNotIn('id', $arr_pass)
                    ->first();

                $round_id = $tests = Round::all()->min('id');

                $tests = Test::with('cate')->where('round_id', $round_curent->id)->orderBy('id', 'ASC')->get();

                $total = UserPassRound::groupBy('user_id')->selectRaw('sum(point) as sum, user_id')->orderBy('sum', 'desc')->get();

                $rank = collect([]);
                foreach ($total as $item) {
                    if ($item->user->level == Auth::guard('web')->user()->level) {
                        $rank->push($item);
                    }
                }

                $top5 = $rank->take(5);

                return view('frontend.pages.self-training', compact(['round_pass', 'arr_pass', 'round_curent', 'round_id', 'tests', 'count_round', 'count_pass_round', 'top5']));
            }
        }
    }

    public function getExam($id, $id_question, Request $request)
    {
        $test = Test::find($id);
        $list_question = Question::where('test_id', $id)->get();

        $question = Question::where('id', $id_question)->first();


        return view('frontend.pages.exam', compact('test', 'list_question', 'question'));
    }

    public function saveAnswer($id, Request $request)
    {
        $countdown = $request->countdown;
        $id_test = $request->id_test;

        $idMin = Question::where('id', '<', $id)->where('test_id', $id_test)->min('id');
        $idMax = Question::where('id', '>', $id)->where('test_id', $id_test)->max('id');

        if ($id > $idMax) {
            $id_user = Auth::guard('web')->user()->id;
            $user_question = new UserQuestion();
            $user_question->user_id = $id_user;
            $user_question->question_id = $id;

            $isset = DB::table('user_question')->where('question_id', $id)->where('user_id', $id_user)->get();

            if (count($isset) > 0) {
                $isset = DB::table('user_question')->where('question_id', $id)->where('user_id', $id_user)->delete();;
            }

            $user_question->selected_answer = $request->answer;
            $countdown = $request->countdown;

            $user_question->save();

            return redirect()->route('get.exam', array('id' => $id_test, 'id_question' => $idMin))->with(['countdown' => $countdown]);
        }

        $nextQuestionID = Question::where('id', '>', $id)->where('test_id', $id_test)->min('id');

        $id_user = Auth::guard('web')->user()->id;
        $user_question = new UserQuestion();
        $user_question->user_id = $id_user;
        $user_question->question_id = $id;
        $isset = DB::table('user_question')->where('question_id', $id)->where('user_id', $id_user)->get();

        if (count($isset) > 0) {
            $isset = DB::table('user_question')->where('question_id', $id)->where('user_id', $id_user)->delete();;
        }

        $user_question->selected_answer = $request->answer;
        $user_question->save();
        
        return redirect()->route('get.exam', array('id' => $id_test, 'id_question' => $nextQuestionID))->with(['countdown' => $countdown]);
    }

    public function getCateNews($id)
    {
        $cate = Category::find($id);
        $news = News::where('cate_id', $id)->orderBy('id', 'desc')->paginate(5);

        return view("frontend.pages.cate-news", compact('news', 'cate'));
    }

    public function newsDetail($id)
    {
        $news = News::find($id);

        return view("frontend.pages.news-detail", compact('news'));
    }

    public function saveResult(Request $request)
    {
        $id = $request->id_test;
        $test = Test::find($id);

        $data = explode(":", $request->time);
        $minutes = $data[0];
        $seconds = $data[1];
        $countdown = ($test->time * 60) - (($minutes * 60) + $seconds);
        $id_user = Auth::guard('web')->user()->id;
        $count_answer_true = DB::table('user_question')
            ->join('question', 'user_question.question_id', '=', 'question.id')
            ->where('user_question.user_id', $id_user)
            ->whereColumn('user_question.selected_answer', '=', 'question.answer_true')
            ->where('question.test_id', $id)->count();
        $point = (100 / $test->number_questions) * $count_answer_true;

        $find_user_count = DB::table('result')->where('user_id', $id_user)->where('test_id', $id)->first();
        if ($find_user_count) {
            Result::where('user_id', $id_user)->where('test_id', $id)
                ->update([
                    'score' => $point,
                    'count' => $find_user_count->count + 1,
                    'time' => $countdown,
                ]);
        } else {
            $result = new Result();
            $result->user_id = $id_user;
            $result->test_id = $id;
            $result->score = $point;
            $result->time = $countdown;
            $result->count = 1;
            $result->save();
        }

        return redirect()->route('self-training')->with(['error_code' => 5, 'test_name' => $test->name, 'count_answer_true' => $count_answer_true, 'answer' => $test->number_questions, 'time' => $countdown, 'point' => $point]);
    }

    public function ranKing()
    {
        return view("frontend.pages.ranking");
    }

    public function getResult()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login');
        } else {
            $round_pass = UserPassRound::with('round')->where('user_id', Auth::guard('web')->user()->id)->get();      
            
            $arr_pass = [];

            foreach ($round_pass as $item) {
                $arr_pass[] = $item->round_id;               
            } 

            $dt = Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            
            $not_pass_rounds = Round::oldest()->with('userPassRounds')->where('level', Auth::guard('web')->user()->level)->where('starting_time', '<=', $dt->toDateString())->whereNotIn('id', $arr_pass)->get();

            $users_level = User::where('level', Auth::guard('web')->user()->level)->with('userPassRounds')->get();
        
            $total = UserPassRound::groupBy('user_id')->selectRaw('sum(point) as sum, user_id')->orderBy('sum', 'desc')->get();

            $rank = collect([]);
            foreach ($total as $item) {
                if ($item->user->level == Auth::guard('web')->user()->level) {
                    $rank->push($item);
                }
            }

            $top5 = $rank->take(5);

            $userIndex = $rank->search(function($user) {
                return $user->user_id == Auth::guard('web')->user()->id;
            });

            $last_round = UserPassRound::with('round')->where('user_id', Auth::guard('web')->user()->id)->orderBy('id', 'desc')->first();  

            if (isset($last_round)) {
                $user_pass_last_round = UserPassRound::with('user')->where('round_id', $last_round->round_id)->orderBy('point', 'desc')->take(5)->get();

                return view("frontend.pages.result", compact(['round_pass', 'not_pass_rounds', 'users_level', 'total', 'top5', 'userIndex', 'last_round', 'user_pass_last_round']));
            } else {
                return view("frontend.pages.result", compact(['round_pass', 'not_pass_rounds', 'users_level', 'total', 'top5', 'userIndex', 'last_round']));
            }
        }
    }

    public function listVideo()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login');
        } else {
            $pass_rounds = UserPassRound::with('round')->where('user_id', Auth::guard('web')->user()->id)->get();

            $pass_videos = collect([]);
            foreach ($pass_rounds as $pass_round) {
                $video_pass_tests = Test::where('round_id', $pass_round->round_id)->get();
                foreach ($video_pass_tests as $video_test) {
                    $pass_videos->push($video_test);
                }
            }

            $arr_pass = [];
            foreach ($pass_rounds as $pass_round) {
                $arr_pass[] = $pass_round->round_id; 
            }

            $not_pass_rounds = Test::oldest()->with('round')->whereNotIn('round_id', $arr_pass)->get();

            $not_pass_videos = collect([]);
            foreach ($not_pass_rounds as $not_pass_round) {
                if ($not_pass_round->round->level == Auth::guard('web')->user()->level) {
                    $not_pass_videos->push($not_pass_round);
                }
            }

            return view("frontend.pages.list-video", compact(['pass_videos', 'not_pass_videos']));
        }
    }

    public function getAcount($id)
    {
        if (session('success_title')) {
            toast(session('success_title'), 'success');
        }

        if (session('error_title')) {
            toast(session('error_title'), 'error');
        }

        $acount = User::find($id);

        return view("frontend.pages.acount-info", compact('acount'));
    }

    public function updateAcount($id, Request $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->date_of_birth = $request->birthday;
        $user->sex = $request->sex;

        $user->save();

        return redirect()->back()->withSuccessTitle('Cập nhật thông tin tài khoản thành công');
 
    }

    public function updatePassword($id, Request $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {

            return redirect()->back()->withErrorTitle('Mật khẩu hiện tại không chính xác');
        }

        if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {

            return redirect()->back()->withErrorTitle('Mật khẩu mới không được giống với mật khẩu hiện tại của bạn. Vui lòng đặt mật khẩu khác');
        }

        $user = User::find($id);
        $user->password = bcrypt($request->get('new_password'));

        $user->save();

        return redirect()->route('user.login')->withSuccessTitle('Đổi mật khẩu thành công');
 
    }

    public function Retest(Request $request)
    {
        $round_id = $request->round_id;
        $test = DB::table('test')->where('round_id', $round_id)->get();
        $query = DB::table('user_question')
            ->join('question', 'user_question.question_id', '=', 'question.id')
            ->join('test', 'question.test_id', '=', 'test.id')
            ->join('round', 'test.round_id', '=', 'round.id')
            ->where('round.id', $request->round_id)
            ->where('user_question.user_id', Auth::guard('web')->user()->id)
            ->delete();

        foreach ($test as $item) {
            $query_resutl = DB::table('result')->where('test_id', $item->id)->where('user_id', Auth::guard('web')->user()->id)->delete();
        }

        return redirect()->back();
    }

    public function saveResultRound(Request $request)
    {
        $user_pass_round = new UserPassRound();
        $user_pass_round->user_id = Auth::guard('web')->user()->id;
        $user_pass_round->round_id = $request->id_round;
        $user_pass_round->point = $request->point;
        $user_pass_round->time = $request->time;

        $user_pass_round->save();

        return redirect()->back()->withSuccessTitle('Lưu kết quả thi thành công');
    }

    public function postRanKing(Request $request)
    {
        if ($request->round == "total") {
            $data_total = UserPassRound::groupBy('user_id')
            ->join('round', 'user_pass_round.round_id', '=', 'round.id')
            ->join('users', 'user_pass_round.user_id', '=', 'users.id')
            ->where('round.level', $request->level)
            ->groupBy('user_pass_round.user_id')->selectRaw('sum(user_pass_round.point) as sum, sum(user_pass_round.time) as sum_time, user_id')
            ->orderBy('sum', 'DESC')
            ->orderBy('sum_time', 'ASC')
            ->limit($request->qty)->get();

            return redirect()->route('get.ranking')->with(['data_total' => $data_total]);
        } else {
            $data = UserPassRound::with('user', 'round')
            ->join('round', 'user_pass_round.round_id', '=', 'round.id')
            ->join('users', 'user_pass_round.user_id', '=', 'users.id')
            ->where('round.level', $request->level)
            ->where('round.name', $request->round)
            ->orderBy('user_pass_round.point', 'DESC')
            ->orderBy('user_pass_round.time', 'ASC')
            ->limit($request->qty)->get();
        
            $round = $data->first();

            return redirect()->route('get.ranking')->with(['data' => $data, 'round' => $round]);
        }
    }

    public function getFeedback()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login');
        } else {
            if (session('success_title')) {
                toast(session('success_title'), 'success');
            }

            return view("frontend.pages.feedback");
        }
    }

    public function sendfeedback(Request $request)
    {
        $feedback = new Feedback();

        $feedback->user_id = Auth::guard('web')->user()->id;
        $feedback->content = $request->feedback;
        $feedback->status = 0;

        $feedback->save();

        return redirect()->back()->withSuccessTitle('Gửi góp ý thành công');
 
    }

    public function training()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login');
        } else {
            $cate_tests = CateTest::all();

            return view('frontend.pages.training', compact('cate_tests'));
        }
    }

    public function postTraining(Request $request)
    {
        $data = QuestionTraining::with('cate')
        ->where('level', $request->level)
        ->where('cate_test_id', $request->cate_test)
        ->get()->random($request->qty)->values()->shuffle();

        return redirect()->route('training')->with(['data' => $data]);
    }
}
