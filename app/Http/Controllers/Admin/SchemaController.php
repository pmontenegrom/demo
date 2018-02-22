<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\Http\Requests\Admin\CreateSchemaRequest;
use App\Http\Requests\Admin\UpdateSchemaRequest;
use App\Http\Requests\Admin\SortSchemaRequest;

use App\CmsSchema;

use View;

class SchemaController extends AdminController {
	
	public $parent;
	public $template;
	public $module_params;

    public function __construct()
    {
		$parent_id = Request::input('parent_id');
		$this->parent= new CmsSchema;

		if(!empty($parent_id)){
			$this->parent = \App\CmsSchema::select()->where('id', $parent_id)->first();
		}

		$this->module_params = '?parent_id='.$this->parent->id;

		View::share('parent', $this->parent);
		View::share('module_params', $this->module_params);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$schemas = CmsSchema::select()
			->where('parent_id', $this->parent->id)
			->orderBy('position', 'asc')
			->Paginate();

        return view('admin.schema.index', array('schemas'=>$schemas));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$schema=new CmsSchema(Request::all());
		$schema->active = '1';

        return view('admin.schema.create', compact('schema'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateSchemaRequest $request)
	{

		$schema = new CmsSchema;
		if (Request::has('parent_id')) $schema->parent_id = $request->parent_id;
		$schema->name = $request->name;
		$schema->admin_view = $request->admin_view;
		$schema->front_view = $request->front_view;
		$schema->iterations = intval($request->iterations);
		$schema->is_page = $request->is_page;
		$schema->active = $request->active;
		$schema->save();

		\App\Util\RegisterLog::add($schema);
		return redirect('admin/schema/'.$this->module_params);
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
		$schema = CmsSchema::FindOrFail($id);

        return view('admin.schema.edit', compact('schema'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateSchemaRequest $request, $id)
	{
		$schema = CmsSchema::FindOrFail($id);
		$schema->name = $request->name;
		$schema->admin_view = $request->admin_view;
		$schema->front_view = $request->front_view;
		$schema->iterations = intval($request->iterations);
		$schema->is_page = $request->is_page;
		$schema->active = $request->active;
		$schema->save();

		\App\Util\RegisterLog::add($schema);
		return redirect('admin/schema/'.$this->module_params);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sort(SortSchemaRequest $request)
	{
		$list=$request->sortlist;
		$i=1;
		foreach ($list as $id) {
			$schema = CmsSchema::FindOrFail($id);
			$schema->position = $i++;
			$schema->save();
		}

		\App\Util\RegisterLog::add();
		return redirect('admin/schema/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$schema = CmsSchema::FindOrFail($id);
		$schema->delete();

		\App\Util\RegisterLog::add($schema);
		return redirect('admin/schema/'.$this->module_params);
	}

}
