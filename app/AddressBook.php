<?php namespace Ecograph;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model {
	protected $table = 'address_books';

	public function Customer() {
        return $this->BelongsTo('Ecograph\Customer');
    }

}
