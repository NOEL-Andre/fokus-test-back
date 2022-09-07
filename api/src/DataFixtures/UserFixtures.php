<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public const USER_REFERENCE = 'user';

    public function load(ObjectManager $manager): void
    {
        $user = (new User())
            ->setFirstname('Andre')
            ->setLastname('NOEL')
            ->setEmail('andre.noel.pro@gmail.com')
        ;

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER_REFERENCE, $user);
    }
}
