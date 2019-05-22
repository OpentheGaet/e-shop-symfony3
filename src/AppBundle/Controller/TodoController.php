<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\to_do_list;
use AppBundle\FormBundle\Type\FormTo_do_listType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TodoController extends Controller
{
    /**
     * @Route("/newToDoList", name="newToDoList")
     */
    public function newTodoAction(Request $request)
    {
        $to_do_list = new to_do_list();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FormTo_do_listType::class, $to_do_list);
        $form->handleRequest($request);

        if ($form->isValid())
        {

            $articles = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($articles);
            $em->flush();
            return $this->redirectToRoute('toDoList');
        }

        return $this->render('template/admin/newToDoList.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/updateToDoList/{id}", name="updateToDoList")
     */
    public function UpdateTodoAction(Request $request,$id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository('AppBundle:to_do_list');
        $to_do_list = $repository->find($id);
        $form = $this->createForm(FormTo_do_listType::class, $to_do_list);


        $form->handleRequest($request);

        if ($form->isValid()) {

            $to_do_list = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($to_do_list);
            $em->flush();
            return $this->redirectToRoute('toDoList');
        }

        return $this->render('template/admin/updateToDoList.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/toDoList", name="toDoList")
     */
    public function showToDoListAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository(to_do_list::class);
        $to_do_list= $repository->findAll();
        return $this->render('template/admin/admin.html.twig', ['fetch' => $to_do_list]);
    }

    /**
     * @Route("/delToDoList/{id}", name="delToDoList")
     */
    public function delToDoList($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(to_do_list::class);
        $to_do_list = $repository->find($id);
        $em->remove($to_do_list);
        $em->flush();
        return $this->redirectToRoute('toDoList');
    }
}
