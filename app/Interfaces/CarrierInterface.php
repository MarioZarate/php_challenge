<?php

namespace App\Interfaces;

use App\Call;
use App\Contact;
use App\SMS;

interface CarrierInterface
{
	
	public function dialContact(Contact $contact);

    public function makeCall(): Call;
    
    public function sendSMS(): SMS;
}