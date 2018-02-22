<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmAction extends Model {

	protected $table = 'adm_actions';

	protected $fillable = ['name', 'write_log'];
}
