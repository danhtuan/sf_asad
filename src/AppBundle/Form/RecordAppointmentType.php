<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Defines the form used to create and manipulate blog posts.
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class RecordAppointmentType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        // For the full reference of options defined by each form field type
        // see http://symfony.com/doc/current/reference/forms/types.html
        // By default, form fields include the 'required' attribute, which enables
        // the client-side form validation. This means that you can't test the
        // server-side validation errors from the browser. To temporarily disable
        // this validation, set the 'required' attribute to 'false':
        //
        //     $builder->add('title', null, array('required' => false, ...));

        $builder
                ->add('isAppointment', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isAppointment',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('clinic', 'entity', array(
                    'class' => 'AppBundle:CatClinic',
                    'empty_value'=>'cat.select_a_value',
                    'choice_label' => 'name',
                    'required'=>false,
                    'label' => 'label.clinic'
                ))
                ->add('appointmentDate', 'date', array(
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => 'label.appointmentDate',
                ))
                ->add('appointmentTime', 'time', array(
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => 'label.appointmentTime',
                ))
                ->add('isWIC', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isWIC',                    
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isChildrenFirst', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isChildrenFirst',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isHealthyStart', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isHealthyStart',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('finalComment', 'textarea', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.finalComment'
                ))
                ->add('btn_back','submit', array(
                    'label' => 'label.back',
                    'attr'=>array(
                        'class'=>'btn btn-primary pull-left',
                    ),
                ))
                ->add('btn_next','submit', array(
                    'label' => 'label.next',
                    'attr'=>array(
                        'class'=>'btn btn-primary pull-right',
                    ),
                ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ClientAppointment',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_record_appointment';
    }

}
