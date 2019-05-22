<?php

namespace AppBundle\Controller;

use AppBundle\Entity\slider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(slider::class);
        $slider = $repository->findAll();
        return $this->render('default/index.html.twig', ['fetch' => $slider]);
    }
}
