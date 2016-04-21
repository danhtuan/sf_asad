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
class RegisterType extends AbstractType {

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
                ->add('firstName', 'text', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.first_name',
                    ),
                    'label' => 'label.first_name',
                ))
                ->add('lastName', 'text', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.last_name',
                    ),
                    'label' => 'label.last_name'
                ))
                ->add('CWID', 'text', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.CWID',
                    ),
                    'label' => 'label.CWID'
                ))
                ->add('email', 'email', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.email',
                    ),
                    'label' => 'label.email'
                ))
                ->add('building', 'text', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.building',
                    ),
                    'label' => 'label.building'
                ))
                ->add('apt', 'text', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.apt',
                    ),
                    'label' => 'label.apt'
                ))
                ->add('phone', 'text', array(
                    'attr' => array(
                        'placeholder' => 'placeholder.phone',
                    ),
                    'label' => 'label.phone_number'
                ))
                ->add('participants', 'collection', array(
                    'label'=>'label.none',
                    'type' => new ParticipantType(),
                    'allow_add'    => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype'    => true,                    
                ))
        ; 
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Resident',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_resident';
    }

}
