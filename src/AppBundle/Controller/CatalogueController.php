<?php


namespace AppBundle\Controller;

use AppBundle\Entity\item;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogueController extends Controller
{
    /**
     * @Route("/catalogue", name="catalogue")
     */
    public function CatalogueAction()
    {
        $repository = $this->getDoctrine()->getRepository(item::class);
        $item = $repository->findAll();
        return $this->render('template/user/catalogue.html.twig', ['fetch' => $item]);
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function ProductAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(item::class);
        $item = $repository->find($id);
        return $this->render('template/user/product.html.twig', ['fetch' => $item]);
    }

    /**
     * @Route("/productASC", name="productASC")
     */
    public function ProductASCAction()
    {
        $repository = $this->getDoctrine()->getRepository(item::class);
        $item = $repository->findBy([], ['price' => 'asc']);
        return $this->render('template/user/productASC.html.twig', [ 'fetch' => $item]);
    }

    /**
     * @Route("/productDESC", name="productDESC")
     */
    public function ProductDESCAction()
    {
        $repository = $this->getDoctrine()->getRepository(item::class);
        $item = $repository->findBy([], ['price' => 'desc']);
        return $this->render('template/user/productDESC.html.twig', [ 'fetch' => $item]);
    }
    
}
