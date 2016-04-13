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
class RecordHealthType extends AbstractType {

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
                ->add('insurance', 'entity', array(
                    'class' => 'AppBundle:CatInsurance',
                    'choice_label' => 'name',
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.insurance',
                    'choice_translation_domain' => 'messages',
                    'required'=>'true'
                ))
                ->add('testLocation', 'choice', array(
                    'choices' => array(1 => 'cat.home_test', 0 => 'cat.healthcare_test'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.testLocation',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('pregAttempted', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.pregAttempted',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isBirthCtrl', 'choice', array(
                    'choices' => array(1 => 'cat.yes', 0 => 'cat.no'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isBirthCtrl',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('birthControl', 'entity', array(
                    'class' => 'AppBundle:CatBirthControl',
                    'empty_value'=>'cat.select_a_value',
                    'choice_label' => 'name',
                    'choice_translation_domain' => 'messages',
                    'label' => 'label.birthControl'
                    
                ))
                ->add('lmp', 'date', array(
                    'widget' => 'single_text',
                    'label' => 'label.lmp',
                ))
                ->add('estDueDate', 'date', array(
                    'widget' => 'single_text',
                    'label' => 'label.est_due_date',
                ))
                ->add('gestation', 'integer', array(
                    'attr' => array(),
                    'label' => 'label.gestation'
                ))
                ->add('numPastPreg', 'integer', array(
                    'attr' => array(),
                    'label' => 'label.numPastPreg'
                ))
                ->add('numLiveBirth', 'integer', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.numLiveBirth'
                ))
                ->add('numStillBirth', 'integer', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.numStillBirth'
                ))
                ->add('numMiscarriages', 'integer', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.numMiscarriages'
                ))
                ->add('numAbortions', 'integer', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.numAbortions'
                ))
                ->add('numTubalPreg', 'integer', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.numTubalPreg'
                ))
                ->add('isCSection', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'required'=>false,
                    'label' => 'label.isCSection',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('dateOfLastBirth', 'date', array(
                    'widget' => 'single_text',
                    'required'=>false,
                    'label' => 'label.dateOfLastBirth',
                ))
                 ->add('isPainFever', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isPainFever',
                    'choice_translation_domain' => 'messages',
                ))
                 ->add('isAbnormalBleeding', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isAbnormalBleeding',
                    'choice_translation_domain' => 'messages',
                ))
                 ->add('isUnusualDischarge', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isUnusualDischarge',
                    'choice_translation_domain' => 'messages',
                ))
                 ->add('isHeadache', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isHeadache',
                    'choice_translation_domain' => 'messages',
                ))
                 ->add('isSevereVomiting', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isSevereVomiting',
                    'choice_translation_domain' => 'messages',
                ))
                 ->add('isUTI', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isUTI',
                    'choice_translation_domain' => 'messages',
                ))
                 ->add('isSwelling', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                     'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isSwelling',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isCramping', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isCramping',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isSafetyI', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isSafetyI',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isSafetyII', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isSafetyII',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isSafetyIII', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isSafetyIII',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isDiabetes', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isDiabetes',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isHeartLungDisease', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isHeartLungDisease',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isSeizures', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isSeizures',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isThyroidProblems', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isThyroidProblems',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isHighBloodPressure', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isHighBloodPressure',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('isPrescriptionMeds', 'choice', array(
                    'choices' => array(0 => 'cat.no', 1 => 'cat.yes'),
                    'empty_value'=>'cat.select_a_value',
                    'label' => 'label.isPrescriptionMeds',
                    'choice_translation_domain' => 'messages',
                ))
                ->add('medications', 'text', array(
                    'attr' => array(),
                    'required'=>false,
                    'label' => 'label.medications'
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
            'data_class' => 'AppBundle\Entity\ClientHealthRecord',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_record_health';
    }

}
