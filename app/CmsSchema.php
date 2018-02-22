<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsSchema extends Model {

	use \Rutorika\Sortable\SortableTrait;

	protected $table = 'cms_schemas';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected static $sortableField = 'position';
	protected static $sortableGroupField = 'parent_id';

	protected $fillable = ['parent_id', 'name', 'admin_view', 'front_view', 'iterations', 'is_page', 'active'];

}
