<?php

namespace Ecograph;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';
    protected $fillable = array('customers_gender',
        'customers_firstname',
        'customers_lastname',
        'customers_dob',
        'email',
        'customers_default_address_id',
        'customers_telephone',
        'customers_telephone1',
        'customers_cel',
        'customers_cel1',
        'password',
        'customers_newsletter',
        'customers_cpf_cnpj',
        'customers_pf_pj',
        'customers_rg_ie',
        'customers_ddd',
        'customers_ddd1',
        'customers_ddd2',
        'customers_atuacao',
        'created_at',
        'update_at'
    );

    /**
     * Relationships
     */
    public function files() {
        return $this->hasMany('Ecograph\File');
    }

    public function AddressBook() {
        return $this->hasMany('Ecograph\AddressBook');
    }

    public function Basket() {
        return $this->hasMany('Ecograph\Basket');
    }

    public function Order() {
        return $this->hasMany('Ecograph\Order');
    }
    public function Orcamento() {
        return $this->hasMany('Ecograph\Orcamento');
    }
    public function Acesso() {
        return $this->hasMany('Ecograph\Acesso');
    }
    public function CustomerDiscount() {
        return $this->hasMany('Ecograph\CustomerDiscount');
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    public static $rules = array(
        'customers_gender' => 'required',
        'customers_firstname' => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/i|min:3|max:32',
        'customers_lastname' => 'required|regex:/^[a-zA-Z\s]*$/|min:3|max:32',
        'customers_dob' => 'date',
        'email' => 'required|email|unique:customers',
        'entry_postcode' => 'required|min:8',
        'entry_street_address' => 'required|min:5|max:120',
        'entry_nr_rua' => 'required|min:1|numeric',
        'entry_comp_ref' => 'regex:/^[0-9a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ\-\'\s]*$/|max:80',
        'entry_ref_entrega' => 'regex:/^[0-9a-zA-ZéúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄçÇ\-\'\s]*$/|max:80',
        'entry_suburb' => 'required|min:5|max:80',
        'entry_city' => 'required|regex:/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/i|min:2|max:80',
        'entry_state' => 'required|min:2|alpha',
        //'customers_ddd' => 'required|min:2',
        'customers_telephone' => 'min:8',
        //'customers_ddd1' => 'required|min:2',
        'customers_telephone1' => 'min:8',
        'customers_cel' => 'min:8',
        'customers_cel1' => 'min:8',
        'password' => 'required|alpha_num|min:8|confirmed',
        'password_confirmation' => 'required|alpha_num|min:8',
        'customers_pf_pj' => 'required'
    );

}
