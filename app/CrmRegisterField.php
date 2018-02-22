<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CmsParameter;
use App\Util\XMLParser;

class CrmRegisterField extends Model {

	protected $table = 'crm_register_fields';

    public function field()
    {
        return $this->belongsTo('App\CrmFormField', 'field_id');
    }

    public function register()
    {
        return $this->belongsTo('App\CrmRegister', 'register_id');
    }

    public function get_value(){

        $field=$this->field;
        switch ($field->type) {
            case 2:
                $value=$this->text;
                break;
            case 3:
                $options=XMLParser::getArray($field->options);
                $value=$options[$this->value]!=null? $options[$this->value]: $this->value;
                break;
            case 4:
                $param=CmsParameter::find($this->value)->first();
                $value=$param!=null?$param->name: $this->value;
                break;
            case 5:
                $value='<a href="'.url('/userfiles/form/'.$this->register->form_id.'/'.$this->value).'" target="_blank">descargar</a>';
                break;
            
            default:
                $value=$this->value;
                break;
        }
        return $value;
    }

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['register_id', 'field_id', 'value', 'txt_value'];

}
