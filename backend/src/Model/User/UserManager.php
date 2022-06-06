<?php

namespace App\Model\User;

use App\Entity\User;
use App\Model\User\Exception\DropUserException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserManager
{
    public const ROLES = [
        'ROLE_USER',
        'ROLE_ADMIN',
        'ROLE_TRANSLATOR_EN',
        'ROLE_TRANSLATOR_DE',
        'ROLE_TRANSLATOR_ES',
        'ROLE_TRANSLATOR_FR',
        'ROLE_TRANSLATOR_NL',
        'ROLE_TRANSLATOR_PL',
        'ROLE_TRANSLATOR_PT-BR',
        'ROLE_TRANSLATOR_RU',
        'ROLE_TRANSLATOR_ZH',
        'ROLE_SERP_PREVIEW'
    ];

    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $userPasswordHasher;
    private ComputerPasswordGenerator $computerPasswordGenerator;

    private ?string $plainPassword = null;

    /**
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param ComputerPasswordGenerator $computerPasswordGenerator
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher, ComputerPasswordGenerator $computerPasswordGenerator)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordHasher = $userPasswordHasher;
        $this->computerPasswordGenerator = $computerPasswordGenerator;
    }

    /**
     * @param UserInterface|PasswordAuthenticatedUserInterface $user
     * @throws \Exception
     */
    public function persist(UserInterface|PasswordAuthenticatedUserInterface $user): void
    {
        $uow = $this->entityManager->getUnitOfWork();
        $uow->computeChangeSets();
        $changeSet = $uow->getEntityChangeSet($user);

        if (!$user->getId() || isset($changeSet['password'])) {
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $user->getPassword()));
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @return UserInterface
     */
    public function create(): UserInterface
    {
        $user = new User();

        $this->plainPassword = $this->computerPasswordGenerator
            ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, false)
            ->generatePassword();

        $user->setPassword($this->plainPassword);

        return $user;
    }

    /**
     * @param UserInterface $user
     * @return bool
     * @throws DropUserException
     */
    public function drop(UserInterface $user): bool
    {
        try {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            throw new DropUserException(
                \sprintf(
                    'Drop user "%s" failed with error: "%s"',
                    $user->getUsername(),
                    $exception->getMessage()
                )
            );
        }

        return true;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
}
