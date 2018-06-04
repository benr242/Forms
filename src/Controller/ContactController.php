<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        /*
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
        */

        $contact = new Contact();
        $contact->setName("..   name   ...");
        $contact->setEmail("...   email   ...");

        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView()
        ]);
    }
}
