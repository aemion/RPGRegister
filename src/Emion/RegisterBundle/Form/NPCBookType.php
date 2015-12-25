<?php

namespace Emion\RegisterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NPCBookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('book', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array('class' => 'EmionRegisterBundle:Book', 'choice_label' => 'name'))
            ->add('page', 'Symfony\Component\Form\Extension\Core\Type\IntegerType')
            ->add('details', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emion\RegisterBundle\Entity\NPCBook'
        ));
    }
}
