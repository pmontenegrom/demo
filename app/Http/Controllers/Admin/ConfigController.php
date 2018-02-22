<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\UpdateConfigRequest;
use App\CmsConfig;

use View;

class ConfigController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$configs = CmsConfig::select()
			->Paginate();

        return view('admin.config.index', array('configs'=>$configs));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$config = CmsConfig::FindOrFail($id);

        return view('admin.config.edit', compact('config'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateConfigRequest $request, $id)
	{
		$config = CmsConfig::FindOrFail($id);
		$config->fill($request->all());
		$config->save();

		\App\Util\RegisterLog::add($config);
		return redirect('admin/config/');
	}

}
