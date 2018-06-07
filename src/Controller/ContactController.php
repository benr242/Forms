<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        /*
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
        */

        $contact = new Contact();
        $contact->setName("..name...");
        //$contact->setEmail("...email...");

        $form = $this->createForm(ContactType::class, $contact);
        /*
        $form = $this->createFormBuilder($contact)
            ->add('name', TextType::class)
            //->add('email', EmailType::class)
            ->add('email', EmailType::class)
            ->add('number', TextType::class)
            ->getForm();
        */

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();

            $em->persist($contact);
            $em->flush();
            //return $this->redirect('http://www.espn.com/nfl/team/_/name/no/new-orleans-saints');
            return $this->redirectToRoute('welcome');
        }

        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView()
        ]);
    }
}
