<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\Http\Requests\Admin\CreateArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;
use App\Http\Requests\Admin\SortArticleRequest;

use App\CmsLang;
use App\CmsArticle;
use App\CmsSchema;

use View;

class ArticleController extends AdminController {
	
	public $schema;
	public $parent;
	public $lang;
	public $module_params;

    public function __construct()
    {
		$schema_id = Request::input('schema_id');
		$parent_id = Request::input('parent_id');
		$lang_id = Request::input('lang_id');
		$page = Request::input('page');

		$this->parent= new CmsArticle;
		$this->schema= new CmsSchema;

		if(!empty($parent_id)){
			$this->parent = \App\CmsArticle::find($parent_id);
			$lang_id=$this->parent->lang_id;
			$this->lang = \App\CmsLang::find($this->parent->lang_id);
		}
		else{
			$this->lang = \App\CmsLang::find($lang_id);
			if(!$this->lang)
				$this->lang = \App\CmsLang::select()->where('active', '1')->first();
		}

		if(!empty($schema_id)){
			$this->schema = \App\CmsSchema::select()->where('id', $schema_id)->first();
		}

		$this->module_params = '?schema_id='.$this->parent->schema_id.'&parent_id='.$this->parent->id.'&lang_id='.$this->lang->id.'&page='.$page;

		View::share('schema', $this->schema);
		View::share('parent', $this->parent);
		View::share('lang', $this->lang);
		View::share('page', $page);

		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$filter = Request::has('filter')? Request::get('filter'): NULL;
		$schemas  = CmsSchema::select()->where('parent_id', $this->parent->schema_id)->where('active', '1')->orderBy('position', 'asc')->get();
		$langs = \App\CmsLang::select()->where('active', '1')->pluck('name', 'id');

		$list = CmsArticle::select()
			->where('parent_id', $this->parent->id)
			->where('lang_id', $this->lang->id)
			->where('title', 'LIKE', '%'.$filter.'%')
			->orderBy('position', 'asc');

		$articles = $list->get();
		$articles_pg = $list
			->Paginate()
			->appends([
				'parent_id'=>$this->parent->id,
				'schema_id'=>$this->parent->schema_id,
				'lang_id'=>$this->lang->id
			]);

		View::share('filter', $filter);
        return view('admin.article.index', array('articles'=>$articles, 'articles_pg'=>$articles_pg, 'schemas'=>$schemas, 'langs'=>$langs));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$article=new CmsArticle(Request::all());
		$article->active = '1';

        return view('admin.article.create', compact('article'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateArticleRequest $request)
	{

		$article = new CmsArticle;
		$article->schema_id = $request->schema_id;
		if (Request::has('parent_id')) $article->parent_id = $request->parent_id;
		$article->lang_id = $request->lang_id;
		$article->title = $request->title;
		$article->subtitle = $request->subtitle;
		$article->subtitle2 = $request->subtitle2;
		$article->resumen = $request->resumen;
		$article->description = $request->description;
		$article->description2 = $request->description2;
		$article->description3 = $request->description3;
		$article->date = $request->date;
		$article->ref_type = $request->ref_type;
		$article->ref_id = $request->ref_id;
		$article->ref_url = $request->ref_url;
		$article->ref_target = $request->ref_target;
		$article->media = \App\Util\XMLParser::ParseArray($request->media);
		$article->param = \App\Util\XMLParser::ParseArray($request->param);
		$article->metas = \App\Util\XMLParser::ParseArray($request->metas);
		$article->in_home = $request->in_home;
		$article->active = $request->active;
		$article->save();

		\App\Util\RegisterLog::add($article);
		return redirect('admin/article/'.$this->module_params);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = CmsArticle::FindOrFail($id);

        return view('admin.article.edit', compact('article'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateArticleRequest $request, $id)
	{
		$article = CmsArticle::FindOrFail($id);
		$article->title = $request->title;
		$article->subtitle = $request->subtitle;
		$article->subtitle2 = $request->subtitle2;
		$article->resumen = $request->resumen;
		$article->description = $request->description;
		$article->description2 = $request->description2;
		$article->description3 = $request->description3;
		$article->date = $request->date;
		$article->ref_type = $request->ref_type;
		$article->ref_id = $request->ref_id;
		$article->ref_url = $request->ref_url;
		$article->ref_target = $request->ref_target;
		$article->media = \App\Util\XMLParser::ParseArray($request->media);
		$article->param = \App\Util\XMLParser::ParseArray($request->param);
		$article->metas = \App\Util\XMLParser::ParseArray($request->metas);
		$article->in_home = $request->in_home;
		$article->slug = $request->slug;
		$article->active = $request->active;
		$article->save();

		\App\Util\RegisterLog::add($article);
		return redirect('admin/article/'.$this->module_params);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sort(SortArticleRequest $request)
	{
		$list=$request->sortlist;
		$i=1;
		foreach ($list as $id) {
			$article = CmsArticle::FindOrFail($id);
			$article->position = $i++;
			$article->save();
		}

		\App\Util\RegisterLog::add();
		return redirect('admin/article/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = CmsArticle::FindOrFail($id);
		$article->delete();

		\App\Util\RegisterLog::add($article);
		return redirect('admin/article/'.$this->module_params);
	}

}
