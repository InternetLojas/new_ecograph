<?php namespace Ecograph\Handlers\Events;

use Ecograph\Events\EmailCustomer;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendEmailNewOrder {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  EmailCustomer  $event
	 * @return void
	 */
	public function handle(EmailCustomer $event)
	{
	//
	}

}
