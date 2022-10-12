<?php

namespace App\DataFixtures;

use App\Entity\Candidate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class CandidateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         

         $faker = Faker\Factory::create('fr_FR');
        
          for($usr = 1; $usr <= 5; $usr++){
             $candidate = new Candidate();             
             $candidate->setCvName($faker->word());
              $candidate->setIsValided(mt_rand(0, 1) == 1 ? true : false);
        $manager->persist($candidate);
     
          }

        $manager->flush();
    }
}