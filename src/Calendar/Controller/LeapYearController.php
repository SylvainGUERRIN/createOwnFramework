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
            $response = new Response('Yep, this is a leap year!'.mt_rand());
        } else {
            $response = new Response('Nope, this is not a leap year.');
        }

        $response->setTtl(10);
        $response->setPublic();
        $response->setMaxAge(600);
        $response->setSharedMaxAge(600);
        $response->setImmutable();
        $response->setLastModified(new \DateTime());
        $response->setEtag('abcde');

        return $response;
    }
}
