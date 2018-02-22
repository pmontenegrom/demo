<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsTranslateGroup extends Model {

	protected $table = 'cms_translates_group';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

}
