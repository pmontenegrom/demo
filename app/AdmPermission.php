<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmPermission extends Model {

	protected $table = 'adm_permissions';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['event_id', 'profile_id'];
}
