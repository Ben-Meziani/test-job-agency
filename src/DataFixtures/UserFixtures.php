<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class UserFixtures extends Fixture
{
   
    public function load(ObjectManager $manager)
    {
        //Fake data for users
        $faker = Faker\Factory::create("fr_FR");
        for ($i = 0; $i < 100; $i++) {
            $user = new User();

            $user->setEmail($faker->email)
                 ->setName($faker->name)
                 ->setLastname($faker->lastname)       
                 ->setAddress($faker->address)
                 ->setPostalCode($faker->postcode)
                 ->setCountry($faker->country)
                 ->setPhone($faker->phoneNumber)
                 ->setPassword($faker->password);
            $manager->persist($user);
          }
          
        $manager->flush();
    }
}