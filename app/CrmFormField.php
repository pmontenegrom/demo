<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmFormField extends Model {

	protected $table = 'crm_form_fields';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['form_id', 'name', 'alias', 'type', 'options', 'active'];

}
