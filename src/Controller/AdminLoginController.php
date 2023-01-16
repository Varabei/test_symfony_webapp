<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminLoginController extends AbstractController
{
    /**
     * @Route("/admin/login", name="app_admin_login")
     */
    public function index(AuthenticationUtils $authUtils): Response
    {
        $error = $authUtils->getLastAuthenticationError();
        $userName = $authUtils->getLastUsername();

        return $this->render('admin_login/index.html.twig', [
            'username' => $userName,
            'error' => $error
        ]);
    }
}
