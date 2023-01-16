<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Form\NotificationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminNotificationsController extends AbstractController
{
    /**
     * @Route("/admin/notifications", name="app_admin_notifications")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $notifications = $doctrine->getRepository(Notification::class)->findAll();

        return $this->render('admin_notifications/index.html.twig', [
            'notifications' => $notifications
        ]);
    }

    /**
     * @Route("/admin/notification/create", name="app_admin_notification_create")
     */
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $notification = new Notification();
        $notification->setDateCreated(new \DateTime());

        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $notification = $form->getData();
            $doctrine->getRepository(Notification::class)->add($notification, true);

            return $this->redirectToRoute('app_admin_notifications');
        }

        return $this->render('admin_notifications/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/notification/edit/{id}", name="app_admin_notification_edit")
     */
    public function edit(int $id, ManagerRegistry $doctrine, Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $notification = $doctrine->getRepository(Notification::class)->find($id);

        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $notification = $form->getData();
            $em->persist($notification);
            $em->flush();

            return $this->redirectToRoute('app_admin_notifications');
        }

        return $this->render('admin_notifications/edit.html.twig', [
            'form' => $form->createView(),
            'id' => $id
        ]);
    }

    /**
     * @Route("/admin/notification/delete/{id}", name="app_admin_notification_delete")
     */
    public function delete(int $id, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $rep = $doctrine->getRepository(Notification::class);

        $notification = $rep->find($id);
        $rep->remove($notification, true);

        return $this->redirectToRoute('app_admin_notifications');
    }
}
