<?php

namespace App\DataFixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixture extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) 
    {
        
            $user = new User();
            $user->setUsername('abdo97');
            $user->setFullname('abdelrahman');
            $user->setEmail('abdo1997@gmail.com');
            $user->setPassword(
                $this->passwordEncoder->encodePassword(
                    $user,'123456789'
                )
            );

            $manager->persist($user);
            $manager->flush();
    }
}
