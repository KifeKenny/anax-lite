<?php

namespace watel\Calandar;

class Month
{
    public $days = [];
    public $monad;
    public $day;
    public $allMonths = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];
    private $today;

    public function __construct($month, $dayNum, $pic, $monthNum)
    {
        $this->today = getdate();
        $this->day = $this->today["mday"];
        $this->monad = $this->today["mon"];
        $this->month = $month;
        $this->pic = $pic;
        $this->monthNum = $monthNum;
        for ($i=$dayNum; $i > 0; $i--) {
            if ($this->day == $i && $this->month == $this->allMonths[$this->monad - 1]) {
                $this->days[] = new Day($i, true);
            } else {
                $this->days[] = new Day($i);
            }
        }
    }
    public function numOfDays()
    {
        return count($this->days);
    }

    public function choosenDay($choosenDay)
    {
        return $this->days[$choosenDay];
    }

    public function firstDayOfMonth($emptyBlocks)
    {
        $send = "";
        for ($i=$emptyBlocks; $i > 0; $i--) {
            $send .= '<div class="day">';
            $send .= '<p class="onlyForPadding"></p>';
            $send .= "</div>";
        }
        return $send;
    }

    public function allDays()
    {
        $skipp = date('N', mktime(0, 0, 0, $this->monthNum, 1));
        echo $this->firstDayOfMonth($skipp - 1);
        $counter = $skipp - 1;
        for ($i=$this->numOfDays(); $i > 0; $i--) {
            $counter += 1;
            $test = $this->choosenDay($i-1);

            if ($counter != 7) {
                echo $test->getDay();
            } else {
                echo $test->getDayRed();
                echo '<div class="divider"></div>';
                $counter = 0;
            }
        }
    }
}
