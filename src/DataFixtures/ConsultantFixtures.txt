<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Consultant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ConsultantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
          for($usr = 1; $usr <= 5; $usr++){
             $consultant = new Consultant();
             $consultant->setLastname($faker->lastName);
             $consultant->setFirstname($faker->firstName);
            // $consultant->setTel($faker->phoneNumber(8));
              
        $manager->persist($consultant);
     
          }
        $manager->flush();
    }
}