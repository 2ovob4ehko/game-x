<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use AppBundle\Entity\Heroes;
use AppBundle\Entity\Users;
use AppBundle\Entity\Warriors;
use AppBundle\Entity\Fights;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{
  /**
  * @Route("/getheroes.json", name="get heroes ajax")
  */
  public function getHeroesAjaxAction()
  {
    $heroes = $this->getDoctrine()
    ->getRepository('AppBundle:Heroes')
    ->findAll();
    if (!$heroes) {
      throw $this->createNotFoundException(
        'alert(Жодного героя не знайдено, немає чим грати :))'
      );
    }
    foreach ($heroes as $hero){
      $hero_array[$hero->getId()]['x']=$hero->getX();
      $hero_array[$hero->getId()]['y']=$hero->getY();
      $hero_array[$hero->getId()]['goal_x']=$hero->getGoalX();
      $hero_array[$hero->getId()]['goal_y']=$hero->getGoalY();
      $hero_array[$hero->getId()]['title']=$hero->getTitle();
      $hero_array[$hero->getId()]['user']=$hero->getUser()->getId();
      $hero_array[$hero->getId()]['color']=$hero->getUser()->getFlag();
    }

    $response = new Response(json_encode($hero_array, JSON_FORCE_OBJECT));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  /**
  * @Route("/setheroes/{id}/{param}/{value}", name="set heroes ajax")
  */
  public function setHeroesAjaxAction($id,$param,$value)
  {
    $em = $this->getDoctrine()->getManager();
    $hero = $em->getRepository('AppBundle:Heroes')
    ->find($id);

    if (!$hero) {
      throw $this->createNotFoundException(
        'Нічого не знайдено за цим ідентифікатором '.$id
      );
    }

    $hero->setParam($param,$value);
    $em->flush();
    return $response = new Response();
  }

  /**
  * @Route("/getwars/{h_id_f}/{h_id_s}", name="get warriors ajax")
  */
  public function getWarriorsAjaxAction($h_id_f,$h_id_s)
  {
    $war1 = $this->getDoctrine()
    ->getRepository('AppBundle:Warriors')
    ->findByHero($h_id_f);
    if (!$war1) {
      $win[0]=2;
      $response = new Response(json_encode($win, JSON_FORCE_OBJECT));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }
    $war2 = $this->getDoctrine()
    ->getRepository('AppBundle:Warriors')
    ->findByHero($h_id_s);
    if (!$war2) {
      $win[0]=1;
      $response = new Response(json_encode($win, JSON_FORCE_OBJECT));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }
    foreach ($war1 as $war){
      $war_array[$war->getId()]['x']=$war->getX();
      $war_array[$war->getId()]['y']=$war->getY();
      $war_array[$war->getId()]['quantity']=$war->getQuantity();
      $war_array[$war->getId()]['wound']=$war->getWound();
      $war_array[$war->getId()]['tired']=$war->getTired();
    }
    foreach ($war2 as $war){
      $war_array[$war->getId()]['x']=$war->getX();
      $war_array[$war->getId()]['y']=$war->getY();
      $war_array[$war->getId()]['quantity']=$war->getQuantity();
      $war_array[$war->getId()]['wound']=$war->getWound();
      $war_array[$war->getId()]['tired']=$war->getTired();
    }

    $response = new Response(json_encode($war_array, JSON_FORCE_OBJECT));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  /**
  * @Route("/setwars/{id}/{param}/{value}", name="set warriors ajax")
  */
  public function setWarriorsAjaxAction($id,$param,$value)
  {
    $em = $this->getDoctrine()->getManager();
    $war = $em->getRepository('AppBundle:Warriors')
    ->find($id);

    if (!$war) {
      throw $this->createNotFoundException(
        'Нічого не знайдено за цим ідентифікатором '.$id
      );
    }

    $war->setParam($param,$value);
    $em->flush();
    return $response = new Response();
  }

  /**
  * @Route("/setturn/{id}/{turn}", name="set turn ajax")
  */
  public function setTurnAjaxAction($id,$turn)
  {
    $em = $this->getDoctrine()->getManager();
    $fight = $em->getRepository('AppBundle:Fights')
    ->find($id);

    if (!$fight) {
      throw $this->createNotFoundException(
        'Нічого не знайдено за цим ідентифікатором '.$id
      );
    }

    $fight->setParam("turn",$turn);
    $em->flush();
    return $response = new Response();
  }

  /**
  * @Route("/getturn/{id}", name="get turn ajax")
  */
  public function getTurnAjaxAction($id)
  {
    $em = $this->getDoctrine()->getManager();
    $fight = $em->getRepository('AppBundle:Fights')
    ->find($id);

    if (!$fight) {
      throw $this->createNotFoundException(
        'Нічого не знайдено за цим ідентифікатором '.$id
      );
    }
    $turn[0]=$fight->getTurn();

    $response = new Response(json_encode($turn, JSON_FORCE_OBJECT));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  /**
  * @Route("/delwar/{id}", name="delete warrior")
  */
  public function delWarriorAjaxAction($id)
  {
    $em = $this->getDoctrine()->getManager();
    $war = $em->getRepository('AppBundle:Warriors')
    ->find($id);

    if (!$war) {
      throw $this->createNotFoundException(
        'Нічого не знайдено за цим ідентифікатором '.$id
      );
    }

    $em->remove($war);
    $em->flush();
    return $response = new Response();
  }

  /**
  * @Route("/newfight/{attacker}", name="create fight")
  */
  public function newFightAjaxAction($attacker)
  {
    $fight = new Fights();
    $fight->setTurn(1);
    $em = $this->getDoctrine()->getManager();
    $hero = $em->getRepository('AppBundle:Heroes')
    ->find($attacker);
    $fight->setAttacker($hero);

    $em->persist($fight);
    $em->flush();

    $id=$fight->getId();

    $response = new Response(json_encode($id, JSON_FORCE_OBJECT));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }
}
