<?php
namespace App\Controller;

use App\Entity\ContactsMessages;
use App\Form\ContactsMessagesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactsMessagesController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ){}

    #[Route('/contact', name: 'app_contacts_messages')]
    public function new(Request $request): Response
    {
        $contactMessage = new ContactsMessages();
        $form = $this->createForm(ContactsMessagesType::class,$contactMessage);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $contactMessage = $form->getData();
            $this->entityManager->persist($contactMessage);
            $this->entityManager->flush();

            $this->addFlash('notice', 'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.');

            return $this->redirectToRoute('app_contacts_messages');
         /*   return new Response("Köszönjük szépen a kérdésedet.
            Válaszunkkal hamarosan keresünk a megadott e-mail címen.");*/
        }

        return $this->render('contactsMessages/contact.html.twig',['form'=> $form]);
    }

  /*  #[Route('/contacts/messages', name: 'app_contacts_messages')]
    public function createContactMessage() : Response
    {
        $contactMessage = new ContactsMessages();
        $contactMessage->setName("Balazs");
        $contactMessage->setEmail("test@email.com");
        $contactMessage->setMessageText("test message text dsfsdfsadfadsfsad");

        $this->entityManager->persist($contactMessage);
        $this->entityManager->flush();

        return new Response('saved new message with id: '. $contactMessage->getId());
    }*/
}
