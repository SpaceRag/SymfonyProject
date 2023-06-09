<?php

namespace App\DataFixtures;

use App\Entity\Ride;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RideFixtures extends AbstractFixtures implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $cities = ['Naples', 'Lyon', 'Marseille', 'Acapulco', 'Ciudad Juárez', 'Cape Town', 'Mexico', 'Moscou', 'LaZup'];

        for ($i = 0; $i < 8; $i ++) {

            $ride = new Ride();
            $ride->setDepart($cities[$this->faker->numberBetween(0, 5)]);
            $ride->setDestination($cities[$this->faker->numberBetween(0, 5)]);
            $ride->setSeats($this->faker->numberBetween(1, 7));
            $ride->setPrice($this->faker->numberBetween(1, 50));
            $ride->setDate($this->faker->dateTime());
            $ride->setCreated($this->faker->dateTime());
            $ride->setDriver($this->getReference("user_" . $this->faker->numberBetween(0, 9)));
            for ($y = 1; $y < $this->faker->numberBetween(1, 3); $y ++) {
                $ride->addRule($this->getReference("rule_" . $this->faker->numberBetween(0, 9)));
            }
            
            $manager->persist($ride);
        }

        $manager->flush();
    }
    
    public function getDependencies()
    {
        return [
            UserFixtures::class,
            RuleFixtures::class,
        ];
    }
} 

