<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository) {
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route("/contacter", name="contact")
     */
    public function index(Request $request): Response
    {
        $name = $request->query->get('name');

        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'name' => $name
        ]);
    }

    /**
     * @Route("/contacter/{city}", name="contactCity")
     */
    public function contactCity(Request $request, string $city): Response
    {
        $name = $request->query->get('name');
        return $this->render('contact/index.html.twig', [
            'city' => $city,
            'name' => $name,
        ]);
    }

    /**
     * @Route("/contacter-id/{id}", name="contactId")
     */
    public function contactId(Request $request): Response
    {
        return $this->render('contact/index.html.twig', [
            'contacts' => $this->contactRepository->findAll()
        ]);
    }
}
