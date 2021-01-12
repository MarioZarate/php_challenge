<?php

namespace Tests;

use App\Services\ContactService;
use PHPUnit\Framework\TestCase;

class ContactServiceTest extends TestCase
{
    public function test_validateNumberWithValidNumber() 
    {
        $contactService = new ContactService();
        $response = $contactService->validateNumber("958-598-831");
        $this->assertTrue($response);
    }

    public function test_validateNumberWithInvalidNumber() 
    {
        $contactService = new ContactService();
        $response = $contactService->validateNumber("958598-831");
        $this->assertFalse($response);
    }
}
