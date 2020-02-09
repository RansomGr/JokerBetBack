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

class EventController extends Controller
{
    /**
     * @Rest\Get("/events")
     */
    public function eventsAction()
    {
        $serializer = $this->get('jms_serializer');
        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Event::class)->findAll(),
                "json"),
            200 ,array(),
            true);
    }


    /**
     * @Rest\Get("/getevents/{id}")
     */
    public function geteventsAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
       // $league = $this->getDoctrine()->getManager()->getRepository(League::class)->find( $request->get("id"));

        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Event::class)->getEventByLeagueAction($request),
                "json"),
            200 ,array(),
            true);
    }




}
