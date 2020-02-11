<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Country;
use AppBundle\Entity\Event;
use AppBundle\Entity\League;
use AppBundle\Entity\Sport;
use AppBundle\Entity\SPORTNAME;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class testController extends Controller
{
    public function indexAction(Request $request)
    {
        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);

        // Drop old database
        $options = array('command' => 'doctrine:database:drop', '--force' => true);
        $application->run(new ArrayInput($options));

        // Make sure we close the original connection because it lost the reference to the database
        $this->getDoctrine()->getManager()->getConnection()->close();

        // Create new database
        $options = array('command' => 'doctrine:database:create');
        $application->run(new ArrayInput($options));

        // Update schema
        $options = array('command' => 'doctrine:schema:update','--force' => true);
        $application->run(new ArrayInput($options));

        // Loading Fixtures, --append option prevent confirmation message
        $options = array('command' => 'doctrine:fixtures:load','--append' => true);
        $application->run(new ArrayInput($options));

        $url = 'https://api.betsapi.com/v1/bwin/prematch?token=36514-cQI1mRR8XaOJD7';
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
       //  var_dump($one);

          //   echo($one["league"]["name"]);
           //      die();
             $aux_event = new Event();
             if(key_exists("AwayTeam",$one)) {
                 $aux_event->setAway($one["AwayTeam"]);
                 $aux_event->setHome($one["HomeTeam"]);
             }
             $aux_event->setId($one["Id"]);
             //$aux_event->setStatus($one["time_status"]);

             $datetime = \DateTime::createFromFormat("Y-m-d H:i:s",$one["Date"]);
             $aux_event->setEventTime($datetime);
             $aux_league =new League();
             $country = new Country();
             $country->setName($one["RegionName"]);
             $country->setIdCountry($one["RegionId"]);

             $aux_leagues = new ArrayCollection();
             $aux_leagues->add($aux_league);
             $country->setLeagues($aux_leagues);
             $sport = new Sport();
             $sport->setId($one["SportId"]);
             $sport->setName(SPORTNAME::$foot_key[$one["SportId"]]);

             $countrysss =   new ArrayCollection();
             $countrysss->add($country);

             $sport->setCountries($countrysss);
             $country->setSport($sport);
             $aux_league->setId($one["LeagueId"]);
             $aux_league->setName($one["LeagueName"]);
             $aux_league->setCountry($country);
             $aux_event->setLeague($aux_league);
             $aux_event->setOurEventId($one["our_event_id"]);
             $em->merge($aux_event);



         }

        $em->flush();


        return new  JsonResponse(json_decode("done"));

        // replace this example code with whatever you need
      /*  return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
      */
    }
}
