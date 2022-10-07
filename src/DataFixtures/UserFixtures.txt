<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@trt.fr');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );

        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr = 1; $usr <= 5; $usr++){
            $user = new User();
            $user->setEmail($faker->email);
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'azerty')
            );
            $manager->persist($user);
        }

        

        $manager->flush();
    }
}