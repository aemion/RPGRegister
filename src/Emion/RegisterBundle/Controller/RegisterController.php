<?php

namespace Emion\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegisterController extends Controller
{
    public function indexAction() {
      $repo = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPCBook');
      $latestRefs = $repo->findBy(array(), array('id' => 'desc'), 10, 0);
      return $this->render('EmionRegisterBundle:Register:index.html.twig', array('latestRefs' => $latestRefs));
    }
}
