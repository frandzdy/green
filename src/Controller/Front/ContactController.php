<?php

namespace App\Controller\Front;

use App\Form\ContactType;
use App\Model\ContactModel;
use App\Service\MailerManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contactez-nous', name: 'contact', methods: ['GET', 'POST'])]
    public function contactUs(
        Request $request,
        MailerManager $mailerManager,
        string $emailContact,
    ): Response {
        $contact = new ContactModel();

        $form = $this->createForm(ContactType::class, $contact, ['action' => $request->getRequestUri()]);
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $vars = [
                'contact' => $contact,
            ];
            $mailerManager->sendMailNotification(
                $emailContact,
                $contact->getEmail(),
                'emails/contact.html.twig',
                $vars
            );
            $this->addFlash('success', 'Votre message a été envoyé.');

            return $this->json(['success' => true, 'redirectUrl' => $this->generateUrl('front_home')]);
        }

        return $this->render('front/contact/index.html.twig', ['form' => $form]);
    }
}
