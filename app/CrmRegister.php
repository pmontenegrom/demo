<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmRegister extends Model {

	protected $table = 'crm_registers';

    public function contact()
    {
        return $this->hasOne('App\CmsParameter', 'id', 'contact_id');
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['form_id', 'contact_id', 'first_name', 'last_name', 'dni', 'address', 'city', 'phone', 'email', 'comments', 'checkin', 'review', 'review_date'];

}
