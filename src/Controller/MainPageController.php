<?php

namespace App\Controller;

use App\Entity\Notification;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainPageController extends AbstractController
{
    public function showMainPage(ManagerRegistry $doctrine): Response
    {
        $notifications = $doctrine->getRepository(Notification::class)->findAll();

        return $this->render('pages/main_page.html.twig', [
            'notifications' => $notifications
        ]);
    }
}