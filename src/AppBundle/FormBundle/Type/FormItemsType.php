<?php

namespace AppBundle\FormBundle\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormItemsType extends AbstractType  {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class, array('label' => 'Marques'))
            ->add('title', TextType::class, array('label' => 'Titre'))
            ->add('OS', TextType::class, array('label' => 'OS'))
            ->add('screen_size', TextType::class, array('label' => 'Ecran'))
            ->add('processor', TextType::class, array('label' => 'Processeur'))
            ->add('RAM', TextType::class, array('label' => 'RAM'))
            ->add('ROM', TextType::class, array('label' => 'ROM'))
            ->add('price', TextType::class, array('label' => 'Prix'))
            ->add('promos', TextType::class, array('label' => 'promotion', 'required' => false))
            ->add('text', TextareaType::class, array('label' => 'Contenu produit'))
            ->add('imageFile', FileType::class, array('label' => 'Image'))
            ->add('categorie', EntityType::class, array('class' => 'AppBundle:categorie', 'choice_label' => 'title', 'label' => 'Categorie'))
            ->add('submit', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\item',
        ));
    }

    public function getName()
    {
        return 'item_image';
    }
    

}
