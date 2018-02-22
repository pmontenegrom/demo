<?php namespace App\Http\Controllers\Ajax;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;

use App\CrmForm;
use App\CrmFormField;
use App\CrmRegister;
use App\CrmRegisterField;
use App\CrmNotify;

use DB;
use View;
use Mail;

class FormController extends Controller {

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

	public function refereshCaptcha(){
	    return captcha_img('simple');
	}

	private function register_field($register, $key, $val){
		$field=CrmFormField::select('id')->Where('form_id', $register->form_id)->Where('alias', $key)->first();
		$rf = new CrmRegisterField;
		$rf->register_id = $register->id;
		$rf->field_id = $field->id;
		$rf->value = $val;
		$rf->save();
	}

	public function store()
	{
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make(['captcha'=>Input::get('captcha')], $rules);
    	$fields=Input::get('fields');
		$files =Input::file('files');

	    if ($validator->fails())
        {
			return response()->json(['resp' => '0', 'msg' => 'El captcha ingresado es incorrecto.']);
        }

        $rules = ['form_id'=>'required', 'email'=>'required', 'checkin'=>'required'];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
			return response()->json(['resp' => '0', 'msg' => 'Algunos datos no se han ingresado correctamente. Por favor complételos.']);
        }

        $form=CrmForm::find(Input::get('form_id'));
        if(!$form)
        {
			return response()->json(['resp' => '0', 'msg' => 'El formulario no se encuentra debidamente registrado, por favor intentelo mas tarde.']);
        }

		$register = new CrmRegister;
		$register->form_id = $form->id;
		$register->contact_id = Input::get('contact_id');
		$register->first_name = Input::get('first_name');
		$register->last_name = Input::get('last_name');
		$register->dni = Input::get('dni');
		$register->address = Input::get('address');
		$register->city = Input::get('city');
		$register->phone = Input::get('phone');
		$register->comments = Input::get('comments');
		$register->checkin = Input::get('checkin');
		$register->email = Input::get('email');
		$register->save();

		if(count($fields)>0){
			foreach($fields as $key=>$val) {
				$this->register_field($register, $key, $val);
			}
		}

		if(count($files)>0){
			foreach($files as $file) {
				$rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
				$validator = Validator::make(array('file'=> $file), $rules);
				if($validator->passes()){
					$path = base_path().'/public/userfiles/form/'.$form->id.'/';
					$extension = $file->getClientOriginalExtension(); // getting image extension
					$filename = uniqid().'.'.$extension; // renameing image

					if($file->move($path, $filename)){
						$this->register_field($register, key($files), $filename);//save register in DB
					}
				}
			}
		}

		//Send mail
		$notifies=CrmNotify::select()
			->where('form_id', $form->id)
			->where('active', '1')
			->get();
		
		$from=array();
		$from['name'] = \App\CmsConfig::where('alias', 'site_name')->first()->value;
		$from['email'] = \App\CmsConfig::where('alias', 'postmaster')->first()->value;

		foreach ($notifies as $notify) {
	        Mail::send('emails.contacto', ['register' => $register], function ($m) use ($notify, $from) {
	        	$m->from($from['email'], $from['name']);
	            $m->to($notify->user->email)->subject('Solicitud de Contacto');
	            if(!empty($notify->recipients)) $m->cc(explode(',', $notify->recipients));
	        });
		}

		return response()->json(['resp' => '1', 'msg' => 'Los datos se registraron correctamente']);
	}

}
