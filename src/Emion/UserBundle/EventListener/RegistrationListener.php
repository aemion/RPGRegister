<?php

namespace Emion\UserBundle\EventListener;

use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RegistrationListener implements EventSubscriberInterface {
  
  private $um;
  
  public function __construct(UserManager $um) {
    $this->um = $um;
  }

  public static function getSubscribedEvents() {
    return array(
      FOSUserEvents::REGISTRATION_COMPLETED => "onRegistrationSuccess",
    );
  }

  public function onRegistrationSuccess(FilterUserResponseEvent $event) {
    $user = $event->getUser();
    $user->addRole('ROLE_AUTHOR');
    $this->um->updateUser($user);
  }
}