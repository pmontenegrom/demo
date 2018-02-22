<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmNotify extends Model {

	protected $table = 'crm_notifies';

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['form_id', 'user_id', 'recipients', 'active'];

}
