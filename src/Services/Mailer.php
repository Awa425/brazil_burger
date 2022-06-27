<?php

namespace App\Services;

use App\Entity\User;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class Mailer
{
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }
    /**
     * @param User $user
     */
    public function sendEmail($user)
    {
        $email = (new Email())
            ->from("BrazilBurger@gmail.com")
            ->to($user->getEmail())
            ->subject("Welcome")
            ->text("Welcome to Brazil Burger")
            ->html(
                $this->twig->render("email/mail.html.twig", [
                    'user' => $user,
                    'subject' => "Welcome"
                ])
            );
        $this->mailer->send($email);
    }
}
