<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CmsArticle extends Model {

    use Sluggable;
    use \Rutorika\Sortable\SortableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cms_articles';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'ParentSlug'
            ]
        ];
    }

	protected static $sortableField = 'position';
	protected static $sortableGroupField = 'parent_id';

    public function getParentSlugAttribute() {
        $pslug=$this->parent!=NULL? $this->parent->slug.'_': '';
        return $pslug . $this->title;
    }

    public function parent()
    {
        return $this->belongsTo('App\CmsArticle', 'parent_id');
    }

    public function schema()
    {
        return $this->belongsTo('App\CmsSchema', 'schema_id');
    }

    public function schemas()
    {
        return $this->hasMany('App\CmsSchema', 'id', 'schema_id');
    }

    public function page_schemas()
    {
        return $this->hasMany('App\CmsSchema', 'id', 'schema_id')
            ->where('is_page', '1')
            ->where('active', '1')
            ->orderBy('position');
    }

    public function children()
    {
        return $this->hasMany('App\CmsArticle', 'parent_id', 'id')
        	->where('active', '1')
        	->orderBy('position');
    }

    public function submenu()
    {
        return $this->hasMany('App\CmsArticle', 'parent_id', 'id')
			->whereIn('schema_id', \App\CmsSchema::select('id')
				->where('is_page', '1')->get()->toArray()
				)
            ->where('active', '1')
        	->orderBy('position');
    }

    public function find_template($front_view)
    {
        return $this->hasOne('App\CmsArticle', 'parent_id', 'id')
            ->whereHas('schemas', function ($query) use($front_view) {
                $query->where('front_view', $front_view);
            });
    }

    public function child_template($front_view)
    {
        return $this->hasMany('App\CmsArticle', 'parent_id', 'id')
            ->whereHas('schemas', function ($query) use($front_view) {
                $query->where('front_view', $front_view);
            })
            ->where('active', '1')
            ->orderBy('position');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['schema_id', 'parent_id', 'lang_id', 'title', 'subtitle', 'subtitle2', 'resumen', 'description', 'description2', 'description3', 'date', 'ref_type', 'ref_id', 'ref_url', 'ref_target', 'media', 'param', 'metas', 'in_home', 'slug', 'active'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = ['schema_id', 'parent_id'];

}
