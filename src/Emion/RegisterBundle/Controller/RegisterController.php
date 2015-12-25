<?php

namespace Emion\RegisterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegisterController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmionRegisterBundle:Register:index.html.twig');
    }
}
