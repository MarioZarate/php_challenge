<?php

namespace App;

use App\Interfaces\CarrierInterface;
use App\Services\ContactService;


class Mobile
{

	protected $provider;
	
	function __construct(CarrierInterface $provider)
	{
		$this->provider = $provider;
	}


	public function makeCallByName($name = '')
	{
		if( empty($name) ) return;

		$contact = ContactService::findByName($name);

		$this->provider->dialContact($contact);

		return $this->provider->makeCall();
    }
    
    public function sendSMSByNumber($number, $body)
    {
        if (empty($body)) return;

        $checkNumber = ContactService::validateNumber($number);
        if (!$checkNumber) {
            return;
        }

        return $this->provider->sendSMS($number, $body);
    }


}
