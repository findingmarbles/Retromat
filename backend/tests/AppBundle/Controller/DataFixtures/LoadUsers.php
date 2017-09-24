<?php
declare(strict_types=1);

namespace tests\AppBundle\Controller\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUsers extends AbstractFixture
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
        $admin->addRole('ROLE_ADMIN');
        $this->setReference('admin', $admin);

        $manager->persist($admin);
        $manager->flush();
    }
}