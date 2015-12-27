<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace Emion\RegisterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Emion\RegisterBundle\Entity\Book;
use Emion\RegisterBundle\Entity\Universe;

class LoadBook implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    $universe = new Universe();
    $universe->setName("Warhammer");
    $universe->setDescription("Un univers un peu dark");
    $universe2 = new Universe();
    $universe2->setName("D&D");
    $universe2->setDescription("Un univers de gros bills");
    $manager->persist($universe2);
    $books = array(
      'Livre de base' => 'Le livre de base de WJDR detaillant les regles principales',
      'Tome de la corruption' => 'Chaos',
      'Tome de la redemption' => 'Dieux de l\'Empire principalement',
      'Bestiaire du vieux monde' => 'Monstres'
    );

    foreach ($books as $name => $desc) {
      $book = new Book();
      $book->setName($name);
      $book->setDescription($desc);
      $book->setUniverse($universe);
      

      $manager->persist($book);
    }

    $manager->flush();
  }
}