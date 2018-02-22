<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\Front\LoginRequest;

use \App\Util\SEO;

use Auth;
use DB;
use View;

class FrontController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Front Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/
	public function __construct()
	{
		//$this->middleware('guest');

		//date_default_timezone_set('America/Lima');
		//setlocale(LC_TIME, "es_PE");
	}

	public function index()
	{
		$page = \App\CmsArticle::whereHas('schemas', function ($query) {
		    $query->where('front_view', 'seccion_home');
		})
		->whereNull('parent_id')
		->first();

		//Page not found
		if(!$page){
			return view('front.maintenance');
		}
		
		$parents=array();

		return view('front.home', array('page'=>$page, 'parents'=>$parents));
	}

	public function page($slug)
	{
		$slug=str_replace('.html', '', $slug);
		$page=\App\CmsArticle::select()->where('slug', $slug)->first();

		//Page not found
		if(!$page){
			$url=SEO::url_notfound();
			return redirect($url);
		}

		//Put content to iframe template
		if(Request::has('iframe')){
			return view('front.iframe', array('page'=>$page));
		}

		$schema=$page->schema;
		//Redirect to parent
		if(!$schema->is_page){
			$url=SEO::url_redirect_id($page->parent_id);
			return redirect($url);
		}

		//Redirect to first children
		if($schema->front_view=='contenedor' && count($page->children)>0){
			$url=SEO::url_article($page->children->first());
			return redirect($url);
		}

		$parent=\App\CmsArticle::find($page->parent_id);
		$parents=array();

		while ($parent!=NULL)
		{
			$parents[]=$parent;
			$parent=\App\CmsArticle::find($parent->parent_id);
		}

		$schema=count($parents)>0 ? $parents[0]->schema: $page->schema;
		$page_view='front.page';

		if($schema->front_view=='intranet'){
			if(!Auth::check())
				$page_view='front.login';
			else
				$page_view='front.intranet';
		}

		return view($page_view, array('page'=>$page, 'parents'=>array_reverse($parents)));
	}

	public function login()
	{
		$page = \App\CmsArticle::whereHas('schemas', function ($query) {
		    $query->where('front_view', 'intranet');
		})
		->whereNull('parent_id')
		->first();

		//Page not found
		if(!$page){
			return view('front.maintenance');
		}

		$parents=array();

		return view('front.login', array('page'=>$page, 'parents'=>$parents));
	}

    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...

			$user = Auth::user();

			var_dump($user); // Returns instance of App\User;

			var_dump($user->adldapUser); // Returns instance of Adldap\Models\User;

            return redirect()->intended('/intranet');
        }
        else
            return redirect('/intranet/login');
    }

}
