<?php namespace Ecograph\Events;

use Ecograph\Events\Event;

use Ecograph\Libs\EnvioEmail;
use Illuminate\Queue\SerializesModels;

class EmailCustomer extends Event {

	use SerializesModels;

    public $email;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(EnvioEmail $email)
	{
		$this->email = $email;
	}

}
