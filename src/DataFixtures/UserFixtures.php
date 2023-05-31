<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixtures
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures
    public function load(ObjectManager $manager)
    {
				// Une boucle de 10 pour générer 10 produits
        for ($i = 0; $i < 10; $i ++) {

						// Instancie un objet Product avec un nom
            $user = new User();
            $user->setEmail($this->faker->email());
            $user->setPassword($this->faker->password());
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
            $user->setPhone($this->faker->phoneNumber());
            $user->setCreated($this->faker->dateTime());


						// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($user);
            $this->setReference('user_' . $i, $user);

            // $adminuser = new User();
            // $adminuser->setEmail($this->faker->email());
            // $adminuser->setPassword($this->faker->password());
            // $adminuser->setFirstName($this->passwordHasher->hashPassword($adminuser, 123456));
            // $adminuser->setLastName($this->faker->lastName());
            // $adminuser->setPhone($this->faker->phoneNumber());
            // $adminuser->setCreated($this->faker->dateTime());

        }

				// Une fois la boucle terminée je persiste les produits fraîchement créés
        $manager->flush();
    }
}