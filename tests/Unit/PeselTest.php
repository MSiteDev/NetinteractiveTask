<?php

namespace Tests\Unit;

use App\Support\Pesel;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PeselTest extends TestCase
{
    public function test__construct()
    {
        Carbon::setTestNow(Carbon::createFromFormat("Y-m-d", "2020-02-03"));
    }

    public function peselProvider()
    {
        return [
            [
                "97050109315",
                "01-05-1997",
                22
            ],
            [
                "92010112345",
                "01-01-1992",
                28
            ],
            [
                "04311269475",
                "12-11-2004",
                15
            ]
        ];
    }

    /**
     * @dataProvider peselProvider
     * @param string $pesel
     * @param string $date
     * @param int $age
     */
    public function testPeselParseBornDateAndAge(string $pesel, string $date, int $age)
    {
        $peselOb = new Pesel($pesel);

        $this->assertEquals($peselOb->getBornDate()->format("d-m-Y"), $date);
        $this->assertEquals($peselOb->getAge(), $age);
    }
}
