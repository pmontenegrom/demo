<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsLang extends Model {

	protected $table = 'cms_langs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'active'];

}
