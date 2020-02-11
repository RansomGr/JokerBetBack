<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
class PaysController extends Controller
{
    /**
     * @Rest\Get("/getPaysBySport/{id_sport}")
     */
    public function getCountryBySportAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        // $league = $this->getDoctrine()->getManager()->getRepository(League::class)->find( $request->get("id"));

        return new JsonResponse(
            $serializer->serialize($this->getDoctrine()->getManager()->getRepository(Country::class)->getCountryBySportIdAction($request),
                "json"),
            200 ,array(),
            true);
    }

}
