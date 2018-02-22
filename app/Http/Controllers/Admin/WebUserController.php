<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

use App\User;

use View;

class WebUserController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$filter = Request::has('filter')? Request::input('filter'): NULL;

		$users=User::select()
			->where('name', 'LIKE', '%'.$filter.'%')
			->whereNull('profile_id')
			->orderBy('name')
			->Paginate();

		View::share('filter', $filter);

        return view('admin.webuser.index', array('users'=>$users));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('admin.webuser.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
		$user = User::Create($request->all());

		\App\Util\RegisterLog::add($user);
		return redirect('admin/webuser/');
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
		$user = User::FindOrFail($id);

        return view('admin.webuser.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateUserRequest $request, $id)
	{
		$user = User::FindOrFail($id);
		$user->fill($request->all());
		$user->active = $request->active;
		$user->save();

		\App\Util\RegisterLog::add($user);
		return redirect('admin/webuser/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::FindOrFail($id);
		$user->delete();

		\App\Util\RegisterLog::add($user);
		return redirect('admin/webuser/');
	}

}
