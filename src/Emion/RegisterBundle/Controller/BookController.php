<?php

namespace Emion\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;

use Emion\RegisterBundle\Entity\Book;
use Emion\RegisterBundle\Form\BookType;

class BookController extends Controller
{
  
  
  public function viewAction($id) {
    $book = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:Book')->findOneById($id);
    return $this->render('EmionRegisterBundle:Book:view.html.twig', array('book' => $book));
  }
  
  public function viewAllAction($page) {
    $resultsByPage = 10;
    $repo = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:Book');
    $listBooks = $repo->findBy(array(), null, $resultsByPage, ($page-1)*$resultsByPage);
    $maxPage = max(1, ceil($repo->getNumberBooks()/$resultsByPage));
    return $this->render('EmionRegisterBundle:Book:viewList.html.twig', array('listBooks' => $listBooks, 'currentPage' => $page, 'maxPage' => $maxPage));
  }
  
  public function addAction(Request $request) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to add a book");
    $book = new Book();
    
    $form = $this->createForm(new BookType(), $book);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($book);
      $em->flush();
      
      $this->get('emion_user.grant_privileges')->grantDefaultPrivileges($book);

      $request->getSession()->getFlashBag()->add('notice', 'Book added.');
      return $this->redirect($this->generateUrl('emion_register_view_book', array('id' => $book->getId())));
    }
    
    return $this->render('EmionRegisterBundle:Book:add.html.twig', array('form' => $form->createView()));
  }
  
  public function editAction($id, Request $request) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to edit a book");
    $book = $this->getDoctrine()->getManager()->getRepository('EmionRegisterBundle:Book')->findOneById($id);
    $this->denyAccessUnlessGranted('EDIT', $book, "You don't have the required permissions to edit this book");
    
    $form = $this->createForm(new BookType(), $book);
                 
    $form->handleRequest($request);

    if ($form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Book edited.');
      return $this->redirect($this->generateUrl('emion_register_view_book', array('id' => $book->getId())));
    }             
    
    return $this->render('EmionRegisterBundle:Book:edit.html.twig', array('book' => $book, 'form' => $form->createView()));
  }
  
  public function delAction($id) {
    $this->denyAccessUnlessGranted('ROLE_AUTHOR', null, "You must be an author to delete a book");
    $em = $this->getDoctrine()->getManager();
    $book = $em->getRepository('EmionRegisterBundle:Book')->findOneById($id);
    $this->denyAccessUnlessGranted('DELETE', $book, "You don't have the required permissions to delete this book");
    $view = $this->render('EmionRegisterBundle:Book:del.html.twig', array('book' => $book));
    if($book != null) {
      $em->remove($book);
      $em->flush();
    }
    return $view;
  }
}
