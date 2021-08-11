<?php

namespace App\DataFixtures;
use App\Entity\Post;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
   /*      // create 10 posts! Bam!
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle('this my title'.$i);
            $post->setBody('this my body'.$i);
            $post->setTime(new \DateTime());

            $manager->persist($post);
        }

        $manager->flush(); */
    }
}
