<?php

namespace CPASimUSante\SimutoolsBundle\Form;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class PluginconfigType
 *
 * the annotation @DI\FormType is mandatory for the factory to be used in listener
 * @DI\FormType;
 */
class PluginconfigType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('param', 'text', array('required' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CPASimUSante\SimutoolsBundle\Entity\Pluginconfig',
            'translation_domain' => 'tools',    //labels translation
            'csrf_protection'    => true        //form security
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cpasimusante_simutoolsbundle_pluginconfig';
    }
}
