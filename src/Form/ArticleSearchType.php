<?php

// src/Form/ArticleSearchType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder
//            ->add('task')
//            ->add('dueDate', null, array('widget' => 'single_text'))
//            ->add('save', SubmitType::class)
//        ;
        $builder->add('searchField');
    }
}