<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
   
    public function load(ObjectManager $manager)
    {
        //Fake data for users
        $faker = Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 20; $i++) {
            $user = new User();

            $user->setEmail($faker->email)
                 ->setPassword($faker->password);
            $manager->persist($user);
          }
          
        $manager->flush();
    }
}