<?php

namespace CCE\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticiasType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('fecha')

            ->add('fuente')
            ->add('dirfuente')
            ->add('foto', 'file', array('required' => false))
            ->add('descripcion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CCE\IntranetBundle\Entity\Noticias'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cce_intranetbundle_noticias';
    }
}
