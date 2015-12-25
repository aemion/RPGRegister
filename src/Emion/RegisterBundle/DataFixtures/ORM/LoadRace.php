<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace Emion\RegisterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Emion\RegisterBundle\Entity\Race;

class LoadRace implements FixtureInterface
{
  // Dans l'argument de la m�thode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de cat�gorie � ajouter
    $names = array(
      'Humain',
      'Haut elfe',
      'Nain',
      'Halfling',
      'Elfe noir',
      'Elfe sylvestre',
      'Orc',
      'Gobelin',
      'Demon',
      'Vampire'
    );

    foreach ($names as $name) {
      // On cr�e la cat�gorie
      $race = new Race();
      $race->setName($name);

      // On la persiste
      $manager->persist($race);
    }

    // On d�clenche l'enregistrement de toutes les cat�gories
    $manager->flush();
  }
}