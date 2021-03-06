<?php

namespace Emion\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;

use Emion\RegisterBundle\Entity\NPC;
use Emion\RegisterBundle\Form\NPCType;
use Emion\RegisterBundle\Entity\NPCBook;
use Emion\RegisterBundle\Form\NPCBookType;

class CharacterController extends Controller
{
    
  public function viewAction($id) {
    $npc = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    $listReferences = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPCBook')->findBy(array('npc' => $npc));
    return $this->render('EmionRegisterBundle:Character:view.html.twig', array('npc' => $npc, 'listReferences' => $listReferences));
  }
  
  
  public function addAction(Request $request) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to add a NPC");
    $npc = new NPC();
    
    $form = $this->createForm(NPCType::class, $npc);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($npc);
      $em->flush();
      
      $this->get('emion_user.grant_privileges')->grantDefaultPrivileges($npc);
      
      $request->getSession()->getFlashBag()->add('notice', 'NPC added.');
      return $this->redirect($this->generateUrl('emion_register_view_npc', array('id' => $npc->getId())));
    }             
    
    return $this->render('EmionRegisterBundle:Character:add.html.twig', array('form' => $form->createView()));
  }
  
  public function editAction($id, Request $request) 
  {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to edit a NPC");
    
    $npc = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    $this->denyAccessUnlessGranted('EDIT', $npc, "You don't have the required permissions to edit this NPC");
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
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to delete a NPC");
    $em = $this->getDoctrine()->getManager();
    $npc = $em->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    $this->denyAccessUnlessGranted('DELETE', $npc, "You don't have the required permissions to delete this NPC");
    $listReferences = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPCBook')->findBy(array('npc' => $npc));
    foreach($listReferences as $ref) {
      $this->denyAccessUnlessGranted('DELETE', $ref, "You don't have the required permissions to delete at least one reference and therefore to delete this NPC");
    }
    $view = $this->render('EmionRegisterBundle:Character:del.html.twig', array('npc' => $npc));
    if($npc != null) {
      $em->remove($npc);
      $em->flush();
    }
    return $view;
  }
  
  public function addRefAction($id, Request $request) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to add a reference");
    $npc = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPC')->findOneById($id);
    $npcbook = new NPCBook();
    $npcbook->setNpc($npc);
    
    
    $form = $this->createForm(NPCBookType::class, $npcbook);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($npcbook);
      $em->flush();
      
      $this->get('emion_user.grant_privileges')->grantDefaultPrivileges($npcbook);

      $request->getSession()->getFlashBag()->add('notice', 'Reference added.');
      return $this->redirect($this->generateUrl('emion_register_view_npc', array('id' => $npc->getId())));
    }             
    
    return $this->render('EmionRegisterBundle:Character:addRef.html.twig', array('npc' => $npc, 'form' => $form->createView()));
  }
  
  public function editRefAction($id, Request $request) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to edit a reference");
    $npcbook = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:NPCBook')->findOneById($id);
    $this->denyAccessUnlessGranted('EDIT', $npcbook, "You don't have the required permissions to edit this reference");
    
    $form = $this->createForm(NPCBookType::class, $npcbook);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Reference edited.');
      if($npcbook->getNpc() != null)
        return $this->redirect($this->generateUrl('emion_register_view_npc', array('id' => $npcbook->getNpc()->getId())));
      else 
        return $this->redirect($this->generateUrl('emion_register_view_all_npc'));
    }             
    
    return $this->render('EmionRegisterBundle:Character:editRef.html.twig', array('reference' => $npcbook, 'form' => $form->createView()));
  }
  
  public function addRefAjaxAction() {
    $npcbook = new NPCBook();
    
    $form = $this->createForm(NPCBookType::class, $npcbook);
   
    return $this->render('EmionRegisterBundle:Character:refForm.html.twig', array('form' => $form->createView()));
  }
  
  public function delRefAjaxAction($id) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to delete a reference");
    $em = $this->getDoctrine()->getManager();
    $ref = $em->getRepository('EmionRegisterBundle:NPCBook')->findOneById($id);
    $this->denyAccessUnlessGranted('EDIT', $ref, "You don't have the required permissions to delete this reference");
    if($ref != null) {
      $em->remove($ref);
      $em->flush();
    }
    return new Response("ref-".$id);
  }
  

}
