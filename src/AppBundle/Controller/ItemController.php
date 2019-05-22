<?php
namespace AppBundle\Controller;

use AppBundle\Entity\item;
use AppBundle\FormBundle\Type\FormItemsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class ItemController extends Controller
{
    /**
     * @Route("/newItems", name="newItems")
     */
    public function newItemsAction(Request $request)
    {
        $item = new item();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FormItemsType::class, $item);
        $form->handleRequest($request);

        if ($form->isValid())
        {

            $item = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            return $this->redirectToRoute('items');
        }

        return $this->render('template/admin/newItems.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/updateItems/{id}", name="updateItems")
     */
    public function UpdateItemsAction(Request $request,$id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository('AppBundle:item');
        $item = $repository->find($id);
        $form = $this->createForm(FormItemsType::class, $item);


        $form->handleRequest($request);

        if ($form->isValid()) {

            $item = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            return $this->redirectToRoute('items');

        }

        return $this->render('template/admin/updateItems.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/items", name="items")
     */
    public function showItemAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository(item::class);
        $item = $repository->findAll();
        return $this->render('template/admin/items.html.twig', ['fetch' => $item]);
    }

    /**
     * @Route("/delItems/{id}", name="delItems")
     */
    public function delItem($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(item::class);
        $item = $repository->find($id);
        $em->remove($item);
        $em->flush();
        return $this->redirectToRoute('items');
    }


}