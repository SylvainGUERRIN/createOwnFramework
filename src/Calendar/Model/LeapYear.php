<?php
namespace Calendar\Model;

class LeapYear
{
    /**
     * @param null $year
     * @return bool
     */
    public function isLeapYear($year = null): bool
    {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
}
