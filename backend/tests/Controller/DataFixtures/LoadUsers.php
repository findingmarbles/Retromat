<?php
declare(strict_types = 1);

namespace App\Tests\Controller\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadUsers extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword('adminPass');
        $admin->setEmail('admin@example.com');
        $admin->setEnabled(true);
        $admin->grantRole('ROLE_ADMIN');

        $this->setReference('admin', $admin);

        $manager->persist($admin);
        $manager->flush();
    }
}
