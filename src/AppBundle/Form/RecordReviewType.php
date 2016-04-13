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
class RecordReviewType extends AbstractType {

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
                ->add('btn_back', 'submit', array(
                    'label' => 'label.back',
                    'attr' => array(
                        'class' => 'btn btn-primary pull-left',
                    ),
                ))
                ->add('btn_submit_list', 'submit', array(
                    'label' => 'label.submit_list',
                    'attr' => array(
                        'class' => 'btn btn-primary pull-right',
                    ),
                ))
                ->add('btn_submit_new', 'submit', array(
                    'label' => 'label.submit_new',
                    'attr' => array(
                        'class' => 'btn btn-primary pull-right',
                    ),
                ));
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
        return 'app_record_review';
    }

}
