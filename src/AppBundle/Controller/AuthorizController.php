<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use AppBundle\Entity\Heroes;
use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AuthorizController extends Controller
{
  /**
  * @Route("/authoriz", name="authoriz")
  */
  public function indexAction()
  {
    return $this->render('authoriz/authoriz.html.twig');
  }

  /**
  * @Route("/registr", name="registr")
  */
  public function registrView()
  {
    return $this->render('authoriz/registr.html.twig');
  }

  /**
  * @Route("/authoriz/action", name="authoriz action")
  */
  public function authorizAction()
  {
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    $user = $this->getDoctrine()
    ->getRepository('AppBundle:Users')
    ->findOneByLogin($login);
    if (!$user) {
      return $this->render('authoriz/authoriz.html.twig',
      array('error'=>'Невірно вказаний логін'));
    }else if($user->getPass()!=$pass){
      return $this->render('authoriz/authoriz.html.twig',
      array('error'=>'Невірно вказаний пароль'));
    }else{
      $user = $this->getDoctrine()
      ->getRepository('AppBundle:Users')
      ->findOneByLogin($login);
      $time = time() + 3600 * 24;
      $response = new Response();
      $response->headers->setCookie(new Cookie('id', $user->getId(), $time));
      $response->headers->setCookie(new Cookie('login', $login, $time));
      $response->headers->setCookie(new Cookie('flag', $user->getFlag(), $time));
      $response->send();
      return $this->redirect($this->generateUrl("homepage"));
    }
  }

  /**
  * @Route("/registr/action", name="registr action")
  */
  public function registrAction()
  {
    $login = $_POST['login'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $user = $this->getDoctrine()
    ->getRepository('AppBundle:Users')
    ->findOneByLogin($login);
    if($user){
      return $this->render('authoriz/registr.html.twig',
      array('error'=>'Такий логін вже зайнятий'));
    }else if (strlen($pass1)<6) {
      return $this->render('authoriz/registr.html.twig',
      array('error'=>'Пароль занадто короткий'));
    }else if ($pass1!=$pass2) {
      return $this->render('authoriz/registr.html.twig',
      array('error'=>'Поле підтвердження не співпадає'));
    }else{
      $color = sprintf("#%06x",rand(0,16777215));
      $user = new Users();
      $user->setLogin($login);
      $user->setPass($pass1);
      $user->setFlag($color);

      $hero = new Heroes(); //default user`s hero
      $hero->setX(1);
      $hero->setY(1);
      $hero->setTitle($login."_1");
      $hero->setGoalX(1);
      $hero->setGoalY(1);
      $hero->setUser($user);

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->persist($hero);
      $em->flush();
      return $this->redirect($this->generateUrl("authoriz"));
    }
  }

  /**
  * @Route("/exit", name="exit")
  */
  public function exitAction()
  {
    $response = new Response();
    $response->headers->clearCookie('login');
    $response->headers->clearCookie('flag');
    $response->send();
    return $this->redirect($this->generateUrl("homepage"));
  }
}
