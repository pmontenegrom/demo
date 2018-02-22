<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsParameter extends Model {

	protected $table = 'cms_parameters';

    public function from_group($alias)
    {
        return $this->hasMany('App\CmsParameter', 'group_id', 'id')
            ->whereIn('group_id', \App\CmsParameterGroup::select('id')
                ->where('alias', $alias)->get()->toArray()
                )
            ->where('active', '1')
            ->orderBy('name');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['group_id', 'lang_id', 'name', 'value', 'active'];

}
