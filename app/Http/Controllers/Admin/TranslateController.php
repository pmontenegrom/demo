<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\CreateTranslateRequest;
use App\Http\Requests\Admin\UpdateTranslateRequest;
use App\CmsLang;
use App\CmsTranslate;
use App\CmsTranslateGroup;

use View;

class TranslateController extends AdminController {

	public $lang;
	public $group;
	public $module_params;

    public function __construct()
    {
		$group_id = Request::input('group_id');
		$lang_id = Request::input('lang_id');
		$this->lang = !empty($lang_id)? \App\CmsLang::find($lang_id): \App\CmsLang::select()->where('active', '1')->first();
		$this->group = !empty($group_id)? \App\CmsTranslateGroup::find($group_id): \App\CmsTranslateGroup::select()->where('active', '1')->first();

		$this->module_params = '?group_id='.$this->group->id.'&lang_id='.$this->lang->id;

		View::share('group_id', $this->group->id);
		View::share('lang_id', $this->lang->id);
		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$langs=CmsLang::select()->where('active', '1')->pluck('name', 'id');
		$groups=CmsTranslateGroup::select()->where('active', '1')->pluck('name', 'id');
		$group_id=$this->group->id;
		
		$translates=CmsTranslate::select()
			->where('lang_id', $this->lang->id)
			->where('name', 'LIKE', '%'.$filter.'%')
			->whereHas('alias', 
				function ($query) use ($group_id){
			    	$query->where('group_id', '=', $group_id);
			    })
			->Paginate();

		View::share('filter', $filter);

        return view('admin.translate.index', array('translates'=>$translates, 'langs'=>$langs));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.translate.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateTranslateRequest $request)
	{
		$translate = CmsTranslate::Create($request->all());

		\App\Util\RegisterLog::add($translate);
		return redirect('admin/translate/');
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
		$translate = CmsTranslate::FindOrFail($id);

        return view('admin.translate.edit', compact('translate'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateTranslateRequest $request, $id)
	{
		$translate = CmsTranslate::FindOrFail($id);
		$translate->fill($request->all());
		$translate->active = $request->active;
		$translate->save();

		\App\Util\RegisterLog::add($translate);
		return redirect('admin/translate/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$translate = CmsTranslate::FindOrFail($id);
		$translate->delete();

		\App\Util\RegisterLog::add($translate);
		return redirect('admin/translate/');
	}

}
