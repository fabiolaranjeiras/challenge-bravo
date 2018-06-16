<?php

use \App\Repositories\RatesRepository as RatesRepository;
use \App\Services\ConverterService as ConverterService;

class ConverterServiceTest extends TestCase
{

    public function testConversionFromBRLtoCAD()
    {
        // setup
        $from = "BRL";
        $to = "CAD";
        $amount = 1.0;
        $brlRate = 3.736404;
        $cadRate = 1.317830;

        $ratesRepository = $this->createMock(RatesRepository::class);

        $ratesRepository->expects($this->exactly(2))
            ->method('getBallastRateFor')
            ->will($this->onConsecutiveCalls($brlRate, $cadRate));

        $converterService = new ConverterService($ratesRepository);

        // execution
        $actual = $converterService->getConversionWith($from, $to, $amount);

        // assertions
        $this->assertEquals(0.35270008275336395, $actual);
    }
}