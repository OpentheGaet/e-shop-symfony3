<?php

namespace AppBundle\Controller;


use AppBundle\Entity\articles;
use AppBundle\Entity\categorie;
use AppBundle\FormBundle\Type\FormArticlesType;
use AppBundle\FormBundle\Type\FormCategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class CategorieController extends Controller
{
    /**
     * @Route("/newCategorie", name="newCategorie")
     */
    public function newCategorieAction(Request $request)
    {
        $categorie = new categorie();
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FormCategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isValid())
        {

            $categorie = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie');
        }

        return $this->render('template/admin/newCategorie.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/updateCategorie/{id}", name="updateCategorie")
     */
    public function UpdateCategorieAction(Request $request,$id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:categorie');
        $categorie = $repository->find($id);

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FormCategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $categorie = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie');
        }

        return $this->render('template/admin/updateCategorie.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/categorie", name="categorie")
     */
    public function showCategorieAction()
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $repository = $this->getDoctrine()->getRepository(categorie::class);
        $categorie = $repository->findAll();
        return $this->render('template/admin/categorie.html.twig', ['fetch' => $categorie]);
    }

    /**
     * @Route("/delCategorie/{id}", name="delCategorie")
     */
    public function delCategorie($id)
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(categorie::class);
        $categorie = $repository->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('categorie');
    }

}

