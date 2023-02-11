<?php

namespace App\Controller;

use App\Form\PostType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
  #[Route('/post/create', name: 'post_create')]
  public function create(): Response
  {
    $form = $this->createForm(PostType::class);

    return $this->render('post/create.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
