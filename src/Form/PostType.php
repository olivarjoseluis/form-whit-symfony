<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
//use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PostType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add(
        'category',
        EntityType::class,
        [
          'class' => Category::class,
          /* 'choices' => ['PHP' => 'php', 'Laravel' => 'laravel', 'Symfony' => 'symfony'], */
          'placeholder' => 'Select a Category',
          'label' => 'Categories'
        ]
      )
      ->add('title', TextType::class, ['label' => 'Post title', 'help' => 'Think about SEO, how do you search on Google?'])
      ->add('body', TextareaType::class, ['label' => 'Content', 'attr' => ['rows' => 9, 'class' => 'bg-light']])
      ->add('Send', SubmitType::class, ['attr' => ['class' => 'btn btn-dark']]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Post::class,
      //'csrf_field_name' => '_custom_token'
      //'csrf_protection' => false,
    ]);
  }
}
