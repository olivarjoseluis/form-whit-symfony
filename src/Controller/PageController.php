<?php

namespace App\Controller;

use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PageController extends AbstractController
{
    #[Route('/contacts-v1', methods: ['GET', 'POST'])]
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
            dd($form->getData(), $request);
        }
        return $this->render('page/contacts-v1.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contacts-v2', methods: ['GET', 'POST'])]
    public function contactsV2(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            dd($form->getData(), $request);
        }
        return $this->render('page/contacts-v2.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contacts-v3', methods: ['GET', 'POST'])]
    public function contactsV3(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            dd($form->getData(), $request);
        }
        return $this->render('page/contacts-v3.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
