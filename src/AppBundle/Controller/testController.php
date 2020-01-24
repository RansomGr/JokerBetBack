<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use AppBundle\Entity\Event;
use AppBundle\Entity\League;
use mysql_xdevapi\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class testController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction(Request $request)
    {
        $url = 'https://api.betsapi.com/v1/bet365/upcoming?token=36343-VIyFL8zzsdX3ZH&sport_id=1';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        if ($data === false) {
            $info = curl_getinfo($ch);
            curl_close($ch);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($ch);
         $em = $this->getDoctrine()->getManager();
         foreach (json_decode(html_entity_decode($data),true)["results"] as $one){
          //   echo($one["league"]["name"]);
           //      die();
             $aux_event = new Event();
             $aux_event->setAway($one["away"]["name"]);
             $aux_event->setId($one["id"]);
             $aux_event->setStatus($one["time_status"]);
             $aux_event->setHome($one["home"]["name"]);
             $datetime = new \DateTime();
             $datetime->setTimestamp($one["time"]);
             $aux_event->setEventTime($datetime);
             $aux_league =new League();
             $aux_league->setCountry(new Country());
             $aux_league->setId($one["league"]["id"]);
             $aux_league->setName($one["league"]["name"]);
             $aux_event->setLeague($aux_league);
             $country = new Country();

             $country->setName("Tounes el 5ra".$one["id"]);
             $aux_league->setCountry($country);
             $aux_event->setHourEventId($one["our_event_id"]);
             $em->merge($aux_event);

         }

        $em->flush();


        return new  JsonResponse(json_decode($data));

        // replace this example code with whatever you need
      /*  return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
      */
    }
}
