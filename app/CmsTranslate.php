<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsTranslate extends Model {

	protected $table = 'cms_translates';

    public function alias()
    {
        return $this->belongsTo('App\CmsTranslateAlias', 'alias_id');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'alias_id', 'lang_id'];

}
