<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contacter", name="contact")
     */
    public function index(Request $request): Response
    {

        $name = $request->query->get('name');
        return $this->render('contact/index.html.twig', [

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
            'name' => $name,
            'city' => $city
        ]);
    }
}
