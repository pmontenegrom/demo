<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsConfig extends Model
{

	protected $table = 'cms_configs';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['type', 'name', 'alias', 'value'];

}
