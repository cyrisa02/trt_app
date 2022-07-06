<?php

namespace App\DataFixtures;

use App\Entity\Recruiter;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RecruiterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');
        for($usr = 1; $usr <= 5; $usr++){
             $recruiter = new Recruiter();
             $recruiter->setLastname($faker->lastName);
             $recruiter->setFirstname($faker->firstName);
             $recruiter->setFirmName($faker->word());
             $recruiter->setAddressFirm($faker->streetAddress);
             $recruiter->setZipcode(str_replace(' ', '', $faker->postcode));
            $recruiter->setCity($faker->city);
              $recruiter->setIsRGPD(mt_rand(0, 1) == 1 ? true : false);
        $manager->persist($recruiter);
     
          }
        $manager->flush();
    }
}