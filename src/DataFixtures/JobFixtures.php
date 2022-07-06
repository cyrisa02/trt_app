<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for($usr = 1; $usr <= 5; $usr++){
             $job = new Job();
             $job->setTitle($faker->lastName);
            
             $job->setDescription($faker->text(350));
             
            $job->setWorkPlace($faker->city);
            $job->setIsVisible(mt_rand(0, 1) == 1 ? true : false);
              
        $manager->persist($job);
     
          }

        $manager->flush();
    }
}