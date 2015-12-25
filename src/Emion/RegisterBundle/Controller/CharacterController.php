<?php

namespace Emion\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Emion\RegisterBundle\Entity\NPC;
use Emion\RegisterBundle\Form\NPCType;
use Emion\RegisterBundle\Entity\NPCBook;
use Emion\RegisterBundle\Form\NPCBookType;

class CharacterController extends Controller
{
  public function viewAction($id) {
    $npc = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    return $this->render('EmionRegisterBundle:Character:view.html.twig', array('npc' => $npc));
  }
  
  public function addAction(Request $request) {
    $npc = new NPC();
    
    $form = $this->createForm(NPCType::class, $npc);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($npc);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'NPC added.');
      return $this->redirect($this->generateUrl('emion_register_view_npc', array('id' => $npc->getId())));
    }             
    
    return $this->render('EmionRegisterBundle:Character:add.html.twig', array('form' => $form->createView()));
  }
  
  public function editAction($id, Request $request) 
  {
    $npc = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    
    $form = $this->createForm(NPCType::class, $npc);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'NPC edited.');
      return $this->redirect($this->generateUrl('emion_register_view_npc', array('id' => $npc->getId())));
    }             
    
    return $this->render('EmionRegisterBundle:Character:edit.html.twig', array('npc' => $npc, 'form' => $form->createView()));
  }
  
  public function viewAllAction($page) {
    $resultsByPage = 10;
    $repo = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPC');
    $listNpc = $repo->findBy(array(), null, $resultsByPage, ($page-1)*$resultsByPage);
    $maxPage = max(1, ceil($repo->getNumberNPC()/$resultsByPage));
    return $this->render('EmionRegisterBundle:Character:viewList.html.twig', array('listNpc' => $listNpc, 'currentPage' => $page, 'maxPage' => $maxPage)); 
  }
  
  public function delAction($id) {
    $em = $this->getDoctrine()->getManager();
    $npc = $em->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    $view = $this->render('EmionRegisterBundle:Character:del.html.twig', array('npc' => $npc));
    if($npc != null) {
      $em->remove($npc);
      $em->flush();
    }
    return $view;
  }
  
  public function addRefAction() {
    $npcbook = new NPCBook();
    
    $form = $this->createForm(NPCBookType::class, $npcbook);
   
    return $this->render('EmionRegisterBundle:Character:refForm.html.twig', array('form' => $form->createView()));
  }
}
