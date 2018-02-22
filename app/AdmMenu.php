<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmMenu extends Model {

	protected $table = 'adm_menus';

    public function children()
    {
        return $this->hasMany('App\AdmMenu', 'parent_id', 'id')
        	->where('active', '1')
        	->orderBy('position');
    }

    public function modules()
    {
        return $this->hasMany('App\AdmModule', 'menu_id', 'id')
        	->where('active', '1')
        	->orderBy('position');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'active'];
}
