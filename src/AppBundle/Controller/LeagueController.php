<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\League;
use AppBundle\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeagueController extends Controller
{
    /**
     * @Rest\Get("/getLeague/{id_country}")
     */
    public function getLeagueByCountryAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
       // $league = $this->getDoctrine()->getManager()->getRepository(League::class)->find( $request->get("id"));

        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(League::class)->countEventsByCountryAction($request),
                "json"),
            200 ,array(),
            true);
    }

}
