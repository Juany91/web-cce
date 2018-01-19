<?php

namespace CCE\IntranetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class UsuarioType extends BaseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('carnet')
            ->add('direccion')
            ->add('roles', 'choice', array('label' => 'Rol', 'required' => true, 'choices' => array( 1 => 'Administrador', 2 => 'Director',3=>'Especialista RRHH',4=>'Especialista'), 'multiple' => true, 'expanded' => true))

            ->add('enabled','choice', array('label' => 'Habilitar Usuario','required' => true,'choices' => array(1 => 'Habilitado', 2 => 'Deshabilitado'),'expanded' => true,'multiple' => false,'mapped' => false,))
        ;
        parent::buildForm($builder, $options);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CCE\IntranetBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'proyecto_empresabundle_usuario';
    }
}
