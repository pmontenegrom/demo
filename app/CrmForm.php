<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmForm extends Model {

	protected $table = 'crm_forms';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'alias', 'active'];

}
