<?php namespace App\Http\Controllers;

use App\Article;
use App\Visitor;
use Illuminate\Http\Request;
use Redirect, Input, Auth;
class HomeController extends Controller {


    public function getIndex()
    {
        $mod = Article::orderBy('updated_at','desc');
        $articles = $mod->paginate(3);
//        $this->assign('articles',$articles);
//        return $this->display('home.index');
        return View('home.index',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getArticle($id)
    {
        $article = Article::find($id);
        return View('home.article',['article'=>$article]);
    }

    /**
     * @param $type
     * @return \Illuminate\View\View
     */
    public function getArticles($type)
    {
        $mod = Article::where('article_type', '=', $type)->orderBy('updated_at','desc');
        $articles = $mod->paginate(3);
//        $this->assign('articles',$articles);
//        return $this->display('home.index');
        return View('home.index',['articles'=>$articles]);
    }

    public function getRegister()
    {
        return View('home.register');
    }

    public function postRegister(Request $request)
    {
        //验证
        $this->validate($request, [
            'username' => 'required|max:255|unique:visitors',
            'password' => 'required|min:6',
            'email'    => 'required|email|max:255|unique:visitors',
        ]);

        $visitor = new Visitor();
        $visitor->username = $request->input('username');
        $visitor->password = bcrypt($request->input('password'));
        $visitor->email = $request->input('email');
        $visitor->phone = $request->input('phone');
        $visitor->save();

        return redirect('auth/login');
        //return redirect($this->redirectPath('auth/login'))->with($this->statusVar, Lang::get('auth.addUserSuccess'));
    }

    /**
     * 动作：登录
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')]))
        {
            return redirect()->back();
        }
        return redirect()->intended('auth/login');
        //   return redirect()->intended('auth/login');
//        $user = User::find(1);
//        Auth::login($user);
//        return redirect()->intended('admin/admin');
    }



}