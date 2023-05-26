<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Form\Extension\PasswordHasher\Type\PasswordTypePasswordHasherExtension;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

abstract class AbstractFixtures extends Fixture
{
    protected Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
}