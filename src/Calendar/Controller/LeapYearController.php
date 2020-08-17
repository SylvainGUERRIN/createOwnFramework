<?php
namespace Calendar\Controller;

use Calendar\Model\LeapYear;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    /**
     * @param Request $request
     * @param $year
     * @return Response
     */
    public function index(Request $request, $year): Response
    {
        $leapYear = new LeapYear();
        if ($leapYear->isLeapYear($year)) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}
