<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MissionFixtures extends Fixture
{
   
    public function load(ObjectManager $manager)
    {
        //Fake data for users
        $faker = Faker\Factory::create("fr_FR");

          for ($j = 0; $j < 100; $j++)
          {
              $mission = new Mission();

              $mission->setTitle($faker->JobTitle)
                      ->setDescription($faker->text)
                      ->setCity($faker->city)
                      ->setAdress($faker->address)
                      ->setPostalCode($faker->postCode)
                      ->setSalary(rand(25000, 45000));

                      $manager->persist($mission);
          }
          
        $manager->flush();
    }
}
