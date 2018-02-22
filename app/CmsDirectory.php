<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsDirectory extends Model {

	protected $table = 'cms_directories';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'type_id', 'alias', 'path', 'active'];

}
