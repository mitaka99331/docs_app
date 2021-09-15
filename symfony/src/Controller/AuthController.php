<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", methods="GET|POST", name="login_page")
     */
    public function login(): Response
    {
        return $this->render('base/login.html.twig');
    }

    /**
     * @Route("/logout", methods="GET", name="logout_page")
     */
    public function logout(): Response
    {
        return $this->render('base/login.html.twig');
    }
}
