<?php

namespace App\DataFixtures;


use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends AbstractFixtures
{
		// La méthode "load" est imposé par la classe Fixture que la classe AbstractFixture étend
		// C'est cette méthode qui permet de créer des fixtures
    public function load(ObjectManager $manager)
    {

      $adminuser = new Users();
            $adminuser->setEmail('admin@admin.fr');
            $adminuser->setPassword($this->passwordHasher->hashPassword($adminuser, 123456));
            $adminuser->setFirstName($this->faker->firstName());
            $adminuser->setLastName($this->faker->lastName());
            $adminuser->setPhone($this->faker->phoneNumber());
            $adminuser->setCreated($this->faker->dateTime());

            $manager->persist($adminuser);
            $this->setReference('user_0', $adminuser);
				// Une boucle de 10 pour générer 10 produits
        for ($i = 1; $i < 11; $i ++) {

						// Instancie un objet Product avec un nom
            $user = new Users();
            $user->setEmail($this->faker->email());
            $user->setPassword($this->passwordHasher->hashPassword($user, 123456));
            $user->setFirstName($this->faker->firstName());
            $user->setLastName($this->faker->lastName());
            $user->setPhone($this->faker->phoneNumber());
            $user->setCreated($this->faker->dateTime());


						// Enregistre le produit fraîchement créé, à faire à chaque tour de boucle
            $manager->persist($user);
            $this->setReference('user_' . $i, $user);

        }
      

				// Une fois la boucle terminée je persiste les produits fraîchement créés
        $manager->flush();
    }
}