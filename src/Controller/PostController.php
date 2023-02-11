<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
  #[Route('/post/create', name: 'post_create', methods: ['GET', 'POST'])]
  public function create(Request $request, EntityManagerInterface $entityManager): Response
  {
    $form = $this->createForm(PostType::class);

    $form->handleRequest($request);
    if ($form->isSubmitted()) {
      $name = $form->getData();
      $entityManager->persist($form->getData());
      $entityManager->flush();

      $this->addFlash('success', "the Pots '{$name->getTitle()}' has been saved successfull");
      return $this->redirectToRoute('post_create');
    }

    return $this->render('post/create.html.twig', [
      'form' => $form->createView(),
    ]);
  }

  #[Route('/post/{id}/edit', name: 'post_edit', methods: ['GET', 'POST'])]
  public function edit(Post $post, Request $request, EntityManagerInterface $entityManager): Response
  {
    $form = $this->createForm(PostType::class, $post);

    $form->handleRequest($request);
    if ($form->isSubmitted()) {
      $name = $form->getData();
      //$entityManager->persist($form->getData()); Optional line
      $entityManager->flush();

      $this->addFlash('success', "the Pots '{$name->getTitle()}' has been edited successfull");
      return $this->redirectToRoute('post_edit', ['id' => $post->getId()]);
    }

    return $this->render('post/edit.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
