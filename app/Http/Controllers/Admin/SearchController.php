<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Course;
use App\Http\Requests\ArticleRequest;
use App\Message;
use App\News;
use App\Post;
use App\Question;
use App\Suggestion;
use App\Test;
use App\User;
use App\UserPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchInAdmin(Request $request)
    {
        $admins=User::where('phone_number','LIKE','%'.$request->value."%")
            ->whereIn('type',['1','2'])
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('admin.searchInAdmins',compact('admins','flag'));
    }

    public function searchInUsers(Request $request)
    {
        $users=User::where('phone_number','LIKE','%'.$request->value."%")
            ->where('type','5')
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('user.searchInUsers',compact('users','flag'));
    }

    public function searchInFirstsTeachers(Request $request)
    {
        $teachers=User::where('phone_number','LIKE','%'.$request->value."%")
            ->where('type','3')
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('teacher.searchInTeachers',compact('teachers','flag'));
    }

    public function searchInTeachers(Request $request)
    {
        $teachers=User::where('phone_number','LIKE','%'.$request->value."%")
            ->where('type','4')
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('teacher.searchInTeachers',compact('teachers','flag'));
    }

    public function searchInCourses(Request $request)
    {
        $courses=Course::where('title','LIKE','%'.$request->value."%")
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('course.searchInCourses',compact('courses','flag'));
    }

    public function searchInTests(Request $request)
    {
        $tests=Test::where('title','LIKE','%'.$request->value."%")
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('test.searchInTests',compact('tests','flag'));
    }

    public function searchInQuestions(Request $request)
    {
        $questions=Question::where('title','LIKE','%'.$request->value."%")
            ->where('test_id',$request->test_id)
            ->orderBy('id','desc')
            ->get();
        $flag=true;
        return view('question.searchInQuestions',compact('questions','flag'));
    }

    public function searchInArticles(Request $request)
    {
        $articles=Article::where('title','LIKE','%'.$request->value."%")
            ->where('type','1')
            ->get();
        $flag=true;
        return view('article.searchTable',compact('articles','flag'));
    }

    public function searchInNews(Request $request)
    {
        $newses=News::where('title','LIKE','%'.$request->value."%")
            ->where('type','2')
            ->get();
        $flag=true;
        return view('news.searchTable',compact('newses','flag'));
    }



    public function searchInMessages(Request $request)
    {
        $messages=Message::where('name','LIKE','%'.$request->value."%")->get();
        $flag=true;
        return view('messages.searchInMessages',compact('messages','flag'));
    }

}
