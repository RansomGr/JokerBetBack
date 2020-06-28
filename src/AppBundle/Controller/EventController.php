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
     * @Rest\Get("/geteventsByLeague/{id}")
     */
    public function geteventsAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Event::class)->getEventByLeagueAction($request),
                "json"),
            200 ,array(),
            true);
    }

    /**
     * @Rest\Get("/countEventsBleague/{id_league}")
     */
    public function countEventsByLeagueAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Event::class)->countEventsByLeagueAction($request),
                "json"),
            200 ,array(),
            true);
    }


    /**
     * @Rest\Get("/countEventsBcountry/{id_country}")
     */
    public function countEventsByCountryAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Event::class)->countEventsByCountryAction($request),
                "json"),
            200 ,array(),
            true);
    }

    /**
     * @Rest\Get("/countEventsBsport/{id_sport}")
     */
    public function countEventsBySportAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');

        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Event::class)->countEventsBySportAction($request),
                "json"),
            200 ,array(),
            true);
    }



}
