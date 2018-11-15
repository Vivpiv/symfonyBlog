<?php
/**
 * Created by PhpStorm.
 * User: wilder20
 * Date: 15/11/18
 * Time: 13:59
 */

namespace App\Form;


use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('category',
                EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',]
            );
    }
    
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => Category::class,
//        ]);
//    }
}