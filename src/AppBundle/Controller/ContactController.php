<?php

namespace AppBundle\Controller;

use AppBundle\Entity\contact;
use Doctrine\DBAL\Types\DateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function ContactAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('firstname',TextType::class)
            ->add('mail',TextType::class)
            ->add('phone', TextType::class, array('required' => false))
            ->add('message', TextareaType::class)
            ->add('date', HiddenType::class)
            ->add('submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid())
        {

            $data = $form->getData();

            $contact= new contact();
            $contact->setName($data['name']);
            $contact->setFirstname($data['firstname']);
            $contact->setMail($data['mail']);
            $contact->setTelephone($data['phone']);
            $contact->setMessage($data['message']);
            $contact->setDate($data['date']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('contact');
        }
        return $this->render('template/user/contact.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/contactAdmin", name="contactAdmin")
     */
    public function showContactAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository(contact::class);
        $contact = $repository->findAll();
        return $this->render('template/admin/contactAdmin.html.twig', ['fetch' => $contact]);
    }

    /**
     * @Route("/delContact/{id}", name="delContact")
     */
    public function delContact($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(contact::class);
        $contact = $repository->find($id);
        $em->remove($contact);
        $em->flush();
        return $this->redirectToRoute('contactAdmin');
    }
}