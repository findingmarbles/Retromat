<?php

declare(strict_types=1);

namespace App\Tests\Controller\DataFixtures;

use App\Entity\User;
use App\Model\User\UserManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadTeamUsers extends Fixture
{
    public const ADMIN_USERNAME = 'admin';
    public const ADMIN_PASSWORD = 'adminPass';
    public const ADMIN_EMAIL = 'admin@example.com';
    public const ADMIN_ROLE = 'ROLE_ADMIN';

    public const SERP_USERNAME = 'serp_user';
    public const SERP_PASSWORD = 'serpPass';
    public const SERP_EMAIL = 'serp@example.com';
    public const SERP_ROLE = 'ROLE_SERP_PREVIEW';

    public const REGULAR_USERNAME = 'regular_user';
    public const REGULAR_PASSWORD = 'regularPass';
    public const REGULAR_EMAIL = 'regular@example.com';

    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager): void
    {
        // Admin user
        $adminUser = new User();
        $adminUser->setUsername(self::ADMIN_USERNAME);
        $adminUser->setPassword(self::ADMIN_PASSWORD);
        $adminUser->setEmail(self::ADMIN_EMAIL);
        $adminUser->setEnabled(true);
        $adminUser->grantRole(self::ADMIN_ROLE);
        $this->setReference(self::ADMIN_USERNAME, $adminUser);
        $this->userManager->persist($adminUser);

        // SERP preview user (with admin role too since SERP might require it)
        $serpUser = new User();
        $serpUser->setUsername(self::SERP_USERNAME);
        $serpUser->setPassword(self::SERP_PASSWORD);
        $serpUser->setEmail(self::SERP_EMAIL);
        $serpUser->setEnabled(true);
        $serpUser->grantRole(self::ADMIN_ROLE);
        $serpUser->grantRole(self::SERP_ROLE);
        $this->setReference(self::SERP_USERNAME, $serpUser);
        $this->userManager->persist($serpUser);

        // Regular user (no special roles)
        $regularUser = new User();
        $regularUser->setUsername(self::REGULAR_USERNAME);
        $regularUser->setPassword(self::REGULAR_PASSWORD);
        $regularUser->setEmail(self::REGULAR_EMAIL);
        $regularUser->setEnabled(true);
        $this->setReference(self::REGULAR_USERNAME, $regularUser);
        $this->userManager->persist($regularUser);
    }
}
