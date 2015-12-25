<?php

namespace Emion\RegisterBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Emion\RegisterBundle\Form\NPCBookType;

class NPCType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder
           ->add('name', 'Symfony\Component\Form\Extension\Core\Type\TextType')
           ->add('location', 'Symfony\Component\Form\Extension\Core\Type\TextType', array('required' => false))
           ->add('activity', 'Symfony\Component\Form\Extension\Core\Type\TextType')
           ->add('birth', 'Symfony\Component\Form\Extension\Core\Type\IntegerType', array('required' => false))
           ->add('death', 'Symfony\Component\Form\Extension\Core\Type\IntegerType', array('required' => false))
           ->add('description', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array('required' => false))
           ->add('race', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array('class' => 'EmionRegisterBundle:Race', 'choice_label' => 'name')) 
           ->add('save', 'Symfony\Component\Form\Extension\Core\Type\SubmitType')
      ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Emion\RegisterBundle\Entity\NPC'
        ));
    }
}
