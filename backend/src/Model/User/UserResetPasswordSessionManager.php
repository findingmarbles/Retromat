<?php


namespace App\Model\User;


use App\Model\User\Model\UserResetPasswordToken;
use Symfony\Component\HttpFoundation\RequestStack;

class UserResetPasswordSessionManager
{
    private RequestStack $requestStack;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->requestStack->getCurrentRequest()->getSession()->set('ResetPasswordPublicToken', $token);
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->requestStack->getCurrentRequest()->getSession()->get('ResetPasswordPublicToken');
    }

    /**
     * @param UserResetPasswordToken $token
     */
    public function setUserResetPasswordTokenObject(UserResetPasswordToken $token): void
    {
        $this->requestStack->getCurrentRequest()->getSession()->set('UserResetPasswordToken', $token->flushToken());
    }

    /**
     * @return UserResetPasswordToken|null
     */
    public function getUserResetPasswordTokenObject(): ?UserResetPasswordToken
    {
        return $this->requestStack->getCurrentRequest()->getSession()->get('UserResetPasswordToken');
    }

    /**
     * @return void
     */
    public function flushSession(): void
    {
        $this->requestStack->getCurrentRequest()->getSession()->remove('ResetPasswordPublicToken');
        $this->requestStack->getCurrentRequest()->getSession()->remove('ResetPasswordCheckEmail');
        $this->requestStack->getCurrentRequest()->getSession()->remove('UserResetPasswordToken');
    }
}
