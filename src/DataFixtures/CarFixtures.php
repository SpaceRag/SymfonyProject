<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {

            $car = new Car();
            $car->setBrand($this->faker->word());
            $car->setModel($this->faker->word());
            $car->setSeats($this->faker->numberBetween(1, 7));
            $car->setCreated($this->faker->dateTime());

            $car->setOwner($this->getReference("user_" . $this->faker->numberBetween(1, 7)));

            $manager->persist($car);
        }

        $manager->flush();
    }

    public function getDependencies()   
    {
        return [
            UserFixtures::class,
        ];
    }
}