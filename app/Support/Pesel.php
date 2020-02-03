<?php

namespace App\Support;

use Carbon\Carbon;

class Pesel
{
    /** @var string  */
    private $pesel;

    /** @var Carbon */
    private $born_date;

    public function __construct(string $pesel)
    {
        $this->pesel = $pesel;
    }

    /**
     * @return \DateTimeInterface|Carbon
     */
    public function getBornDate() : Carbon
    {
        if(!$this->born_date)
            $this->parseBornDate();

        return $this->born_date;
    }

    public function getAge() : int
    {
        return $this->getBornDate()->diffInYears();
    }

    public function getUpTo18String() : ?string
    {
        $startDate = Carbon::now();

        $targetDate = $this->getBornDate()->addYears(18);

        if($targetDate < $startDate)
            return null;

        $years = 0;

        while($targetDate->diffInYears($startDate) > 0)
        {
            $years++;
            $startDate->addYear();
        }

        $days = $targetDate->diffInDays($startDate);


        return "{$years} years and {$days} days";
    }

    private function parseBornDate() : void
    {
        $year = (int)substr($this->pesel, 0, 2);
        $month = (int)substr($this->pesel, 2, 2);
        $day = substr($this->pesel, 4, 2);

        switch((int)($month/20))
        {
            case 0:
                $year += 1900;
                break;
            case 1:
                $year += 2000;
                break;
            case 2:
                $year += 2100;
                break;
            case 3:
                $year += 2200;
                break;
            case 4:
                $year += 1800;
                break;
        }

        $realMonth = $month % 20;

        $this->born_date = Carbon::createFromFormat("Y-m-d", "{$year}-{$realMonth}-{$day}");
    }
}