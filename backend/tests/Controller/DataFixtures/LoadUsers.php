<?php

declare(strict_types=1);

namespace App\Tests\Controller\DataFixtures;

use App\Entity\User;
use App\Model\User\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadUsers extends Fixture
{
    public const ROLE = 'ROLE_ADMIN';
    public const USERNAME = 'admin';
    public const PASSWORD = 'adminPass';
    public const EMAIL_ADDRESS = 'admin@example.com';

    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager): void
    {
        $adminUser = new User();
        $adminUser->setUsername(self::USERNAME);
        $adminUser->setPassword(self::PASSWORD);
        $adminUser->setEmail(self::EMAIL_ADDRESS);
        $adminUser->setEnabled(true);
        $adminUser->grantRole(self::ROLE);

        $this->setReference(self::USERNAME, $adminUser);

        $this->userManager->persist($adminUser);
    }
}
