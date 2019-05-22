<?php
namespace AppBundle\Controller;

use AppBundle\Entity\slider;
use AppBundle\FormBundle\Type\FormSliderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SliderController extends Controller
{
    /**
     * @Route("/newSlider", name="newSlider")
     */
    public function newSliderAction(Request $request)
    {
        $slider = new slider();

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(FormSliderType::class, $slider);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $slider = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();
            return $this->redirectToRoute('slider');
        }

        return $this->render('template/admin/newSlider.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/updateSlider/{id}", name="updateSlider")
     */
    public function updateSliderAction(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository('AppBundle:slider');
        $slider = $repository->find($id);
        $form = $this->createForm(FormSliderType::class, $slider);


        $form->handleRequest($request);

        if ($form->isValid()) {

            $slider = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($slider);
            $em->flush();
            return $this->redirectToRoute('slider');

        }

        return $this->render('template/admin/updateSlider.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/slider", name="slider")
     */
    public function showSliderAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $repository = $this->getDoctrine()->getRepository(slider::class);
        $slider = $repository->findAll();
        return $this->render('template/admin/slider.html.twig', ['fetch' => $slider]);
    }

    /**
     * @Route("/delSlider/{id}", name="delSlider")
     */
    public function delSlider($id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(slider::class);
        $slider = $repository->find($id);
        $em->remove($slider);
        $em->flush();
        return $this->redirectToRoute('slider');
    }

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(slider::class);
        $slider = $repository->findAll();
        return $this->render('default/index.html.twig', ['fetch' => $slider]);
    }

}

