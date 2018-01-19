<?php

namespace CCE\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
            //->add('ficha')
            ->add('foto', 'file', array('required' => false))
            ->add('pdf', 'file', array('required' => false))
            ->add('idueb')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CCE\IntranetBundle\Entity\Producto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cce_intranetbundle_producto';
    }
}
