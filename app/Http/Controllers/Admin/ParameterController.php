<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\CreateParameterRequest;
use App\Http\Requests\Admin\UpdateParameterRequest;
use App\CmsLang;
use App\CmsParameter;
use App\CmsParameterGroup;

use View;

class ParameterController extends AdminController {

	public $lang;
	public $group;
	public $module_params;

    public function __construct()
    {
		$group_id = Request::input('group_id');
		$lang_id = Request::input('lang_id');
		$this->lang = !empty($lang_id)? \App\CmsLang::find($lang_id): \App\CmsLang::select()->where('active', '1')->first();
		$this->group = !empty($group_id)? \App\CmsParameterGroup::find($group_id): \App\CmsParameterGroup::select()->where('active', '1')->first();

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
		$groups=CmsParameterGroup::select()->where('active', '1')->pluck('name', 'id');

		$parameters=CmsParameter::select()
			->where('group_id', $this->group->id)
			->where('lang_id', $this->lang->id)
			->where('name', 'LIKE', '%'.$filter.'%')
			->orderBy('name')
			->Paginate();

		View::share('filter', $filter);

        return view('admin.parameter.index', array('parameters'=>$parameters, 'groups'=>$groups, 'langs'=>$langs));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$parameter=new CmsParameter(Request::all());
		$parameter->active = '1';

        return view('admin.parameter.create', compact('parameter'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateParameterRequest $request)
	{
		$parameter = CmsParameter::Create($request->all());

		\App\Util\RegisterLog::add($parameter);
		return redirect('admin/parameter/'.$this->module_params);
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
		$parameter = CmsParameter::FindOrFail($id);

        return view('admin.parameter.edit', compact('parameter'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateParameterRequest $request, $id)
	{
		$parameter = CmsParameter::FindOrFail($id);
		$parameter->fill($request->all());
		$parameter->active = $request->active;
		$parameter->save();

		\App\Util\RegisterLog::add($parameter);
		return redirect('admin/parameter/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$parameter = CmsParameter::FindOrFail($id);
		$parameter->delete();

		\App\Util\RegisterLog::add($parameter);
		return redirect('admin/parameter/'.$this->module_params);
	}

}
