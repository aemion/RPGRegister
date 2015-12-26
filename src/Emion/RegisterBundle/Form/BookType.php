<?php

namespace Emion\RegisterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->add('universe', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array('class' => 'EmionRegisterBundle:Universe', 'choice_label' => 'name'))
            ->add('description', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array('required' => false))
            ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emion\RegisterBundle\Entity\Book'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'emion_registerbundle_book';
    }
}
