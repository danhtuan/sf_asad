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
class RecordBaseType extends AbstractType {

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
                ->add('operatorName', 'text', array(
                    'attr' => array(
                        'disabled'=>'true'
                    ),
                    'label' => 'label.help_operator',
                ))
                ->add('firstName', 'text', array(
                    'attr' => array(
//                        'placeholder' => 'placeholder.first_name',
//                        'data-help' => 'help.firstName'
                    ),
                    'label' => 'label.first_name',
                ))
                ->add('middleName', 'text', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.middle_name'
                ))
                ->add('lastName', 'text', array(
                    'attr' => array(),
                    'label' => 'label.last_name'
                ))
                ->add('dob', 'birthday', array(
                    'attr' => array(),
                    'label' => 'label.date_of_birth',
                    'widget' => 'single_text',
                ))
                ->add('age', 'integer', array(
                    'attr' => array(),                   
                    'label' => 'label.age'
                ))
                ->add('race', 'entity', array(
                    'class' => 'AppBundle:CatRace',
                    'choice_label' => 'name',
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.race',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isHispanic', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.ethnicity',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('streetAddress', 'text', array(
                    'attr' => array(),
                    'label' => 'label.street_address'
                ))
                ->add('city', 'text', array(
                    'attr' => array(),
                    'label' => 'label.city'
                ))
                ->add('zipcode', 'text', array(
                    'attr' => array(),
                    'label' => 'label.zipcode'
                ))
                ->add('phoneNumber', 'text', array(
                    'attr' => array(),
                    'label' => 'label.phone_number'
                ))
                ->add('canMessage', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.message_ok',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('otherNumber', 'text', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.other_phone_number'
                ))
                ->add('maritalStatus', 'entity', array(
                    'class' => 'AppBundle:CatMaritalStatus',
                    'choice_label' => 'maritalStatus',
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.marital_status',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('education', 'entity', array(
                    'class' => 'AppBundle:CatEducation',
                    'choice_label' => 'name',
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.education',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('currentSchool', 'text', array(
                    'attr' => array(),
                    'label' => 'label.current_school'
                ))
                ->add('isEmployed', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.is_employed',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('numHouseHold', 'integer', array(
                    'attr' => array(),
                    'label' => 'label.num_household'
                ))
                ->add('income', 'entity', array(
                    'class' => 'AppBundle:CatIncome',
                    'choice_label' => 'name',
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.income',
                    'choice_translation_domain' => 'messages',
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
            'data_class' => 'AppBundle\Entity\ClientRecord',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_record';
    }

}
