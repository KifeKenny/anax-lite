<?php

namespace watel\Calandar;

class Calandar
{
    public $year = [];
    public $allMonth = [
        "January" => [
            "name" => "January",
            "days" => 31,
            "pic" => "img/months/jan.jpg",
        ],
        "February" => [
            "name" => "February",
            "days" => 28,
            "pic" => "img/months/feb.jpg",
        ],
        "March" => [
            "name" => "March",
            "days" => 31,
            "pic" => "img/months/mars.jpg",
        ],
        "April" => [
            "name" => "April",
            "days" => 30,
            "pic" => "img/months/april.jpg",
        ],
        "May" => [
            "name" => "May",
            "days" => 31,
            "pic" => "img/months/may.jpg",
        ],
        "June" => [
            "name" => "June",
            "days" => 30,
            "pic" => "img/months/juni.jpg",
        ],
        "July" => [
            "name" => "July",
            "days" => 31,
            "pic" => "img/months/july.jpg",
        ],
        "August" => [
            "name" => "August",
            "days" => 31,
            "pic" => "img/months/aug.jpg",
        ],
        "September" => [
            "name" => "September",
            "days" => 30,
            "pic" => "img/months/sep.jpg",
        ],
        "October" => [
            "name" => "October",
            "days" => 31,
            "pic" => "img/months/oct.jpg",
        ],
        "November" => [
            "name" => "November",
            "days" => 30,
            "pic" => "img/months/nov.jpg",
        ],
        "December" => [
            "name" => "December",
            "days" => 31,
            "pic" => "img/months/dec.jpg",
        ],
    ];
    public function __construct()
    {
        $counter = 1;
        foreach ($this->allMonth as $key => $value) {
            if ($key == "monkey") {
                echo "yes";
            }
            $this->year[] = new Month($value["name"], $value["days"], $value["pic"], $counter);
            $counter += 1;
        }
    }

    public function getMonth($monthNum)
    {
        return $this->year[$monthNum];
    }

    public function dumpObj()
    {
        var_dump($this->year);
    }
}
