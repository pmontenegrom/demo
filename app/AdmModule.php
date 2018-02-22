<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmModule extends Model {

	protected $table = 'adm_modules';

    public function events()
    {
        return $this->hasMany('App\AdmEvent', 'module_id', 'id');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'active'];
}
