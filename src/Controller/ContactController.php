<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactController extends Controller
{
    /**
     * @Route("/new", name="new")
     */
    public function index(Request $request, EntityManagerInterface $em, \Swift_Mailer $mailer)
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
            //$contactFormData = $form->getData();
            dump($contact);

            $em->persist($contact);
            $em->flush();

            /*$contacts = $this->getDoctrine()
                ->getRepository(Contact::class)
                ->findAll();

            $message = (new \Swift_Message('You got Mail!!'))
                ->setFrom('benr242@gmail.com')
                ->setTo('benr242@gmail.com')
                ->setBody('eeeeeeeeee  eeeeeeeeeeee eeeeeeeeeeeeeee eeeeeeeeeee')
                ;

            $mailer->send($message);
            */
            //return $this->redirect('http://www.espn.com/nfl/team/_/name/no/new-orleans-saints');
            return $this->redirectToRoute('list', [
                'msg' => "hello world!!",
            ]);
        }

        return $this->render('contact/index.html.twig', [
            'our_form' => $form->createView()
        ]);
    }


    /**
     * @Route("/list", name="list")
     */
    public function list(Request $request, EntityManagerInterface $em)
    {
        $contact = $this->getDoctrine()
            ->getRepository(Contact::class)
            ->findAll();

        return $this->render('index/index.html.twig', [
            'msg' => 'test message',
        ]);
    }
}
