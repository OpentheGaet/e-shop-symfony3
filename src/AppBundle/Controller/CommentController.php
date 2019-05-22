<?php

namespace AppBundle\Controller;

use AppBundle\Entity\comment;
use AppBundle\FormBundle\Type\FormCommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @Route("/newComment", name="newComment")
     */
    public function CommmentAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('user', TextType::class)
            ->add('item', EntityType::class, array('class' => 'AppBundle:item', 'choice_label' => 'title'))
            ->add('comment', TextareaType::class)
            ->add('submit', SubmitType::class)
            ->add('date', HiddenType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid())
        {

            $data = $form->getData();

            $comment= new comment();
            $comment->setUser($data['user']);
            $comment->setItem($data['item']);
            $comment->setComment($data['comment']);
            $comment->setDate($data['date']);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('showComment');
        }
        return $this->render('template/user/newComment.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/showComment", name="showComment")
     */
    public function showCommentAction()
    {
        $repository = $this->getDoctrine()->getRepository(comment::class);
        $comment = $repository->findAll();
        return $this->render('template/user/showComment.html.twig', ['fetchComment' => $comment]);
    }

    /**
     * @Route("/commentAdmin", name="commentAdmin")
     */
    public function showCommentAdminAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository(comment::class);
        $comment = $repository->findAll();
        return $this->render('template/admin/commentAdmin.html.twig', ['fetch' => $comment]);
    }

    /**
     * @Route("/delCommentAdmin/{id}", name="delCommentAdmin")
     */
    public function delCommentAdmin($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(comment::class);
        $comment = $repository->find($id);
        $em->remove($comment);
        $em->flush();
        return $this->redirectToRoute('commentAdmin');
    }
}