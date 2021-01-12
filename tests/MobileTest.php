<?php

namespace Tests;

use App\Call;
use App\Contact;
use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Mobile;
use App\Interfaces\CarrierInterface;
use App\SMS;

class MobileTest extends TestCase
{
	
	/** @test */
	public function it_returns_null_when_name_empty()
	{
        $provider = $this->getMockBuilder(CarrierInterface::class)
                ->setMockClassName('NationalCarrier')
                ->getMock();
		$mobile = new Mobile($provider);

		$this->assertNull($mobile->makeCallByName(''));
    }
    
    public function test_makeCallByName() 
    {
        $contactServiceMock = m::mock('alias:App\Services\ContactService');
        $contactServiceMock
            ->shouldReceive('findByName')
            ->andReturn(new Contact());
        $contactServiceMock
            ->shouldReceive('validateNumber')
            ->andReturn(true);
        
        $provider = $this->getMockBuilder(CarrierInterface::class)
                ->setMockClassName('NationalCarrier')
                ->getMock();
        $provider->method('dialContact')->willReturn(true);
        $provider->method('makeCall')->willReturn(new Call());
        $provider->method('sendSMS')->willReturn(new SMS());
        $mobile = new Mobile($provider);
        $this->assertInstanceOf(Call::class, $mobile->makeCallByName('TestUser'));
    }

    public function test_sendSMSByNumber()
    {
        $contactServiceMock = m::mock('alias:App\Services\ContactService');
        $contactServiceMock
            ->shouldReceive('validateNumber')
            ->andReturn(true);

        $provider = $this->getMockBuilder(CarrierInterface::class)
                ->setMockClassName('NationalCarrier')
                ->getMock();
        $provider->method('dialContact')->willReturn(true);
        $provider->method('makeCall')->willReturn(new Call());
        $provider->method('sendSMS')->willReturn(new SMS());
        $mobile = new Mobile($provider);

        $this->assertInstanceOf(SMS::class, $mobile->sendSMSByNumber('958-598-831', 'Hello World!'));
    }
}
