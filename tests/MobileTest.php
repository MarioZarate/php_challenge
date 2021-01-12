<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Mobile;
use App\Interfaces\CarrierInterface;

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

}
