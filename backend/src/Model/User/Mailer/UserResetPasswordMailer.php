<?php

namespace App\Model\User\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class UserResetPasswordMailer
{
    private string $from;
    private string $subject;
    private string $template;
    private MailerInterface $mailer;

    public function __construct(string $from, string $subject, string $template, MailerInterface $mailer)
    {
        $this->from = $from;
        $this->subject = $subject;
        $this->template = $template;
        $this->mailer = $mailer;
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function send(string $to, array $context): void
    {
        $this->mailer->send(
            $this->prepare(
                $to,
                $context
            )
        );
    }

    private function prepare(string $to, array $context): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from(new Address($this->from))
            ->to($to)
            ->subject($this->subject)
            ->textTemplate($this->template)
            ->context($context);
    }
}
