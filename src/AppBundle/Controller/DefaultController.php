<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Heroes;
use AppBundle\Entity\Users;
use AppBundle\Entity\Warriors;
use AppBundle\Entity\Classes;
use AppBundle\Entity\Fights;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
      $cookies = $this->getRequest()->cookies->all();
      if(!isset($cookies['login'])){
        return $this->redirect($this->generateUrl("authoriz"));
      }else{
        return $this->render('default/index.html.twig',
        array(
          'login'=>$cookies["login"],
          'flag'=>$cookies["flag"]
          ));
      }
    }

    /**
     * @Route("/fight", name="fight")
     */
    public function fightAction()
    {
      $cookies = $this->getRequest()->cookies->all();
      if(!isset($cookies['login'])){
        return $this->redirect($this->generateUrl("authoriz"));
      }else{
        return $this->render('default/fight.html.twig',
        array(
          'login'=>$cookies["login"],
          'flag'=>$cookies["flag"],
          'h_id_f'=>$_POST['h_id_f'],
          'h_id_s'=>$_POST['h_id_s']
          ));
      }
    }

    /**
     * @Route("js/view.js", name="view.js")
     */
    public function viewJsAction()
    {
      $cookies = $this->getRequest()->cookies->all();
      $heroes = $this->getDoctrine()
      ->getRepository('AppBundle:Heroes')
      ->findAll();
      if (!$heroes) {
        throw $this->createNotFoundException(
          'alert(Жодного героя не знайдено, немає чим грати :))'
        );
      }
      foreach ($heroes as $hero){
        $hero->color=$hero->getUser()->getFlag();
      }
      $rendered = $this->renderView('default/view.js.twig',
      array(
        'heroes'=>$heroes,
        'id'=>$cookies["id"]
        ));
      $response = new Response($rendered);
      $response->headers->set('Content-Type','text/javascript');
      return $response;
    }

    /**
     * @Route("js/fight.js/{h_id_f}/{h_id_s}", name="fight.js")
     */
    public function fightJsAction($h_id_f,$h_id_s)
    {
      $cookies = $this->getRequest()->cookies->all();
      if($h_id_f==$cookies["id"]){
        $num=1;
      }else{$num=2;}
      $warriors1 = $this->getDoctrine()
      ->getRepository('AppBundle:Warriors')
      ->findByHero($h_id_f);
      $warriors2 = $this->getDoctrine()
      ->getRepository('AppBundle:Warriors')
      ->findByHero($h_id_s);
      $clases = $this->getDoctrine()
      ->getRepository('AppBundle:Classes')
      ->findAll();
      if (!$clases) {
        throw $this->createNotFoundException(
          'alert(Жодного класу не знайдено)'
        );
      }else if (!$warriors1 || !$warriors2) {
        if(!$warriors1){
          $warriors=$warriors2;
          $h_id=$h_id_f;
          $rendered = $this->renderView('default/fight.js.twig',
          array('win'=>2));
        }else{
          $warriors=$warriors1;
          $h_id=$h_id_s;
          $rendered = $this->renderView('default/fight.js.twig',
          array('win'=>1));
        }
        //Обнулити координати виживших військ
        foreach ($warriors as $war){
          $war->setX(0);
          $war->setY(0);
          $this->getDoctrine()->getManager()->flush();
        }
        //видалення запису битви
        $hero = $this->getDoctrine()
        ->getRepository('AppBundle:Heroes')
        ->findById($h_id);
        $this->getDoctrine()->getManager()->remove($hero[0]->getFight());
        $this->getDoctrine()->getManager()->flush();
        //обнулення значення ід битви у кожного героя хто брав участь
        $hero1 = $this->getDoctrine()
        ->getRepository('AppBundle:Heroes')
        ->findById($h_id_f);
        $hero2 = $this->getDoctrine()
        ->getRepository('AppBundle:Heroes')
        ->findById($h_id_s);
        $hero1[0]->setFight();
        $hero2[0]->setFight();
        if(count($hero)>0){
          $heroes = $this->getDoctrine()
          ->getRepository('AppBundle:Heroes')
          ->findByUser($hero[0]->getUser()->getId());
          if(count($heroes)>1){
            $this->getDoctrine()->getManager()->remove($hero[0]);
            $this->getDoctrine()->getManager()->flush();
          }
        }
        $response = new Response($rendered);
        $response->headers->set('Content-Type','text/javascript');
        return $response;
      }else {
        if($warriors1[0]->getHero()->getFight()==NULL){
          $fight = new Fights();
          $fight->setTurn(1);
          $fight->setAttacker($warriors1[0]->getHero());

          $warriors1[0]->getHero()->setFight($fight);
          $warriors2[0]->getHero()->setFight($fight);

          $em = $this->getDoctrine()->getManager();
          $em->persist($fight);
          $em->flush();
        }
        foreach ($warriors1 as $war){
          $war->color=$war->getHero()->getUser()->getFlag();
          $war->clasid=$war->getClass()->getId();
          $war->userid=$war->getHero()->getUser()->getId();
          $name1=$war->getHero()->getUser()->getLogin();
          $fightId=$war->getHero()->getFight()->getId();
          $fightTurn=$war->getHero()->getFight()->getTurn();
        }
        foreach ($warriors2 as $war){
          $war->color=$war->getHero()->getUser()->getFlag();
          $war->clasid=$war->getClass()->getId();
          $war->userid=$war->getHero()->getUser()->getId();
          $name2=$war->getHero()->getUser()->getLogin();
        }
        $rendered = $this->renderView('default/fight.js.twig',
        array(
          'wars1'=>$warriors1,
          'wars2'=>$warriors2,
          'clases'=>$clases,
          'id'=>$cookies["id"],
          'num'=>$num,
          'userName1'=>$name1,
          'userName2'=>$name2,
          'fightId'=>$fightId,
          'fightTurn'=>$fightTurn,
          'win'=>0
          ));
        $response = new Response($rendered);
        $response->headers->set('Content-Type','text/javascript');
        return $response;
      }
    }
}
