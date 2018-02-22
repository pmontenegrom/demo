<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsFileType extends Model {

	protected $table = 'cms_filetypes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'extensions', 'active'];

}
