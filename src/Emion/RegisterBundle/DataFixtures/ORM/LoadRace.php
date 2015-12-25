<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace Emion\RegisterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Emion\RegisterBundle\Entity\Race;

class LoadRace implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
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
      // On crée la catégorie
      $race = new Race();
      $race->setName($name);

      // On la persiste
      $manager->persist($race);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}