<?php

namespace App\DataFixtures;

use App\Entity\vinylMix;
use App\Factory\VinylmixFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        VinylmixFactory::createMany(25);
        $manager->flush();
    }
}