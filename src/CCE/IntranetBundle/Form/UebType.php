<?php

namespace CCE\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UebType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('tipo', 'choice', array('label' => 'Tipo', 'required' => true, 'choices' => array( 1 => 'Unidad Productiva', 2 => 'Unidad de Apoyo'), 'multiple' => true, 'expanded' => true))

            ->add('descripcion')

            ->add('foto', 'file', array('required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CCE\IntranetBundle\Entity\Ueb'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cce_intranetbundle_ueb';
    }
}
