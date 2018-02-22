<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsParameterGroup extends Model {

	protected $table = 'cms_parameters_group';

    public function parameters()
    {
        return $this->hasMany('App\CmsParameter', 'group_id', 'id')
        	->where('active', '1')
        	->orderBy('name');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'alias', 'active'];

}
