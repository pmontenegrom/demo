<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsTranslateAlias extends Model {

	protected $table = 'cms_translates_alias';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'group_id'];

}
