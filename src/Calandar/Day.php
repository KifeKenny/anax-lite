<?php

namespace watel\Calandar;

class Day
{
    public function __construct($day, $active = false)
    {
        $this->day = $day;
        $this->active = $active;
    }

    public function getDay()
    {
        if ($this->active) {
            $send = '<div class="day  green">';
            $send .= '<p class="onlyForPadding">' . "$this->day</p>";
        } else {
            $send = '<div class="day">';
            $send .= "<p class=onlyForPadding>$this->day</p>";
        }
        $send .= "</div>";
        return $send;
    }
    //jag borde tänka igeom mina kod mer känns
    //som dem sista delarna blev bara lite småfixar här och där
    public function getDayRed()
    {
        $send = '<div class="day  red">';
        $send .= '<p class="onlyForPadding">' . "$this->day</p>";
        $send .= "</div>";
        return $send;
    }
}
