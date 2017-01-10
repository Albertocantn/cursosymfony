<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CursoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titulo', TextType::class,array("required"=>"required","attr"=>array("class"=>"form-title form")))
        ->add('descripcion', TextareaType::class)
        ->add('precio', TextType::class)
        ->add('Guardar', SubmitType::class);
    }
       // ->add('categoria',\Symfony\Component\Form\Extension\Core\Type\ChoiceType::class,array('choices' => array("html"=>"Html","php"=>"Php")))
      // no se puede añadir un campo que no exista en la entidad COMBOBOX

    //->add('Pais',\Symfony\Component\Form\Extension\Core\Type\CheckboxType::class,array('label' => 'Seleccione un pais',"required => true"))



    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Curso'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_curso';
    }


}
