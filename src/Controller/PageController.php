<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Post::class)->findAll();

        return $this->render('page/index.html.twig', ['posts' => $posts]);
    }

    #[Route('/contacts-v1', name: 'contacts-v1', methods: ['GET', 'POST'])]
    public function contactsV1(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('email', TextType::class)
            ->add('message', TextareaType::class, ['label' => 'Comment, suggest or message'])
            ->add('save', SubmitType::class, ['label' => 'Send'])
            //->setMethod('GET')
            //->setAction('other-action')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            //dd($form->getData(), $request);
            $this->addFlash('success', 'Test on form # 1 success');
            return $this->redirectToRoute('contacts-v1');
        }
        return $this->render('page/contacts-v1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contacts-v2', name: 'contacts-v2', methods: ['GET', 'POST'])]
    public function contactsV2(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            //dd($form->getData(), $request);
            $this->addFlash('success', 'Test on form # 2 success');
            return $this->redirectToRoute('contacts-v2');
        }
        return $this->render('page/contacts-v2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contacts-v3', name: 'contacts-v3', methods: ['GET', 'POST'])]
    public function contactsV3(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            //dd($form->getData(), $request);
            $this->addFlash('info', 'Test on form # 3 success');
            return $this->redirectToRoute('contacts-v3');
        }
        return $this->render('page/contacts-v3.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
