<?php
// src/OC/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace Emion\RegisterBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Emion\RegisterBundle\Entity\Book;

class LoadBook implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $books = array(
      'Livre de base' => 'Le livre de base de WJDR detaillant les regles principales',
      'Tome de la corruption' => 'Chaos',
      'Tome de la redemption' => 'Dieux de l\'Empire principalement',
      'Bestiaire du vieux monde' => 'Monstres'
    );

    foreach ($books as $name => $desc) {
      // On crée la catégorie
      $book = new Book();
      $book->setName($name);
      $book->setDescription($desc);
      

      // On la persiste
      $manager->persist($book);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}