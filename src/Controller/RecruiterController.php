<?php

namespace App\Controller;

use App\Entity\Recruiter;
use App\Form\RecruiterType;
use App\Repository\RecruiterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recruteur')]
class RecruiterController extends AbstractController
{
    #[Route('/', name: 'app_recruiter_index', methods: ['GET'])]
    public function index(RecruiterRepository $recruiterRepository): Response
    {
        return $this->render('pages/recruiter/index.html.twig', [
            'recruiters' => $recruiterRepository->findAll(),
        ]);
    }

    #[Route('/creation', name: 'app_recruiter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RecruiterRepository $recruiterRepository): Response
    {
        $recruiter = new Recruiter();
        $form = $this->createForm(RecruiterType::class, $recruiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruiterRepository->add($recruiter, true);

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/recruiter/new.html.twig', [
            'recruiter' => $recruiter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recruiter_show', methods: ['GET'])]
    public function show(Recruiter $recruiter): Response
    {
        return $this->render('pages/recruiter/show.html.twig', [
            'recruiter' => $recruiter,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_recruiter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recruiter $recruiter, RecruiterRepository $recruiterRepository): Response
    {
        $form = $this->createForm(RecruiterType::class, $recruiter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recruiterRepository->add($recruiter, true);

            return $this->redirectToRoute('app_recruitertovalid_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/recruiter/edit.html.twig', [
            'recruiter' => $recruiter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recruiter_delete', methods: ['POST'])]
    public function delete(Request $request, Recruiter $recruiter, RecruiterRepository $recruiterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recruiter->getId(), $request->request->get('_token'))) {
            $recruiterRepository->remove($recruiter, true);
        }

        return $this->redirectToRoute('app_recruiter_index', [], Response::HTTP_SEE_OTHER);
    }
}