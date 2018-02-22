<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\CreateNotifyRequest;
use App\Http\Requests\Admin\UpdateNotifyRequest;

use App\CrmForm;
use App\CrmNotify;

use View;

class NotifyController extends AdminController {

	public $form;
	public $module_params;

    public function __construct()
    {
		$form_id = Request::input('form_id');
		$this->form = !empty($form_id)? \App\CrmForm::find($form_id): \App\CrmForm::select()->where('active', '1')->first();

		$this->module_params = '?form_id='.$this->form->id;

		View::share('form_id', $this->form->id);
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

		$forms=CrmForm::select()->pluck('name', 'id');
		$notifies=CrmNotify::select()
			->where('form_id', $this->form->id)
			->whereHas('user', 
				function ($query) use($filter){
					$query->where('name', 'LIKE', '%'.$filter.'%');
			    })
			->Paginate();

		View::share('filter', $filter);

        return view('admin.notify.index', array('notifies'=>$notifies, 'forms'=>$forms));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$notify=new CrmNotify(Request::all());
		$notify->active = '1';

		$form_id=$this->form->id;
		$users=\App\User::select()
			->whereNotIn('id', \App\CrmNotify::select('user_id')
					->where('form_id', $this->form->id)
					->where('active', '1')->get()->toArray()
				)
			->pluck('name', 'id');

        return view('admin.notify.create', compact('notify', 'users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateNotifyRequest $request)
	{

		$notify =new CrmNotify;
		$notify->fill($request->all());
		$notify->recipients=preg_replace(array("/;/", "/\n\r/", "/\r\n/", "/\t/"), ",", str_replace(' ', '', $request->recipients));
		$notify->save();

		\App\Util\RegisterLog::add($notify);
		return redirect('admin/notify/'.$this->module_params);
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
		$notify = CrmNotify::FindOrFail($id);

		$users=\App\User::whereNotIn('id', \App\CrmNotify::select('user_id')
					->where('active', '1')
					->where('user_id', '<>', $notify->user_id)
					->get()->toArray()
				)->where('active', '1')->pluck('name', 'id');

        return view('admin.notify.edit', compact('notify', 'users'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateNotifyRequest $request, $id)
	{
		$notify = CrmNotify::FindOrFail($id);
		$notify->fill($request->all());
		$notify->recipients=preg_replace(array("/;/", "/\n\r/", "/\r\n/", "/\t/"), ",", str_replace(' ', '', $request->recipients));
		$notify->active = $request->active;
		$notify->save();

		\App\Util\RegisterLog::add($notify);
		return redirect('admin/notify/'.$this->module_params);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$notify = CrmNotify::FindOrFail($id);
		$notify->delete();

		\App\Util\RegisterLog::add($notify);
		return redirect('admin/notify/'.$this->module_params);
	}

}
