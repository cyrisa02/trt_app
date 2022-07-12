<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Form\CandidatureType;
use App\Form\JobContactType;
use App\Repository\CandidatureRepository;
use App\Repository\UserRepository;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidature')]
class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_candidature_index', methods: ['GET'])]
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('pages/candidature/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
            
        ]);
    }

    #[Route('/creation', name: 'app_candidature_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CandidatureRepository $candidatureRepository): Response
    {
        $candidature = new Candidature();
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidatureRepository->add($candidature, true);

            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/candidature/new.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_show', methods: ['GET'])]
    public function show(Candidature $candidature): Response
    {
        return $this->render('pages/candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    #[Route('/{id}/edition', name: 'app_candidature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository, MailerService $mailer ): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidatureRepository->add($candidature, true);
           // $mailMessage = $candidature->getUser;
           $mailMessage='coucou';
            $mailer->sendEmail(content: $mailMessage);

            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

       

        return $this->renderForm('pages/candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form ,
            
        ]);
    }

    #[Route('/details/{id}', name: 'details', methods: ['GET','POST'])]
    public function details($id, CandidatureRepository $candidatureRepository, Request $request)
    {
        $candidature = $candidatureRepository->findOneBy(['id'=>$id]);

        if(!$candidature){
            throw new NotFoundHttpException('Pas d\'annonce trouvée');
        }

        $form = $this->createForm(JobContactType::class);

        $contact = $form->handleRequest($request);
        
        return $this->renderForm('pages/candidature/details.html.twig', [
            'candidature'=>$candidature,
            'form'=>$form->createView()
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_delete', methods: ['POST'])]
    public function delete(Request $request, Candidature $candidature, CandidatureRepository $candidatureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $candidatureRepository->remove($candidature, true);
        }

        return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
    }
}