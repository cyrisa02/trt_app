<?php

namespace App\Controller;

use App\Entity\Consultant;
use App\Entity\Recruiter;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\RegistrationFormTypeConsultant;
use App\Security\UserAuthenticator;
use App\Form\RegistrationFormTypeRecrut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription_candidat', name: 'app_register_candidate')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_CANDIDATE"])
            // encode the plain password
                ->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register_candidate.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/inscription_recruteur', name: 'app_register_recruiter')]
    public function register2(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();        
        $form = $this->createForm(RegistrationFormTypeRecrut::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_RECRUITER"])
            // encode the plain password
                ->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register_recruiter.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
    * Create the user as consultant
    */

    #[Route('/inscription_consultant', name: 'app_register_consultant')]
    public function register3(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();        
        $form = $this->createForm(RegistrationFormTypeConsultant::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        // incrémentation de sa clé primaire du consultant
            $consultant = new Consultant();
            // On récupère la saisie des champs nom, prénom et téléphone    
            $consultant->setLastname($form->get('lastname')->getData())
            ->setFirstname($form->get('firstname')->getData())
            ->setTel($form->get('tel')->getData());

             //vient chercher la clé étrangère  ne pas oublier de persister   
            $user->setConsultant($consultant);

            $user->setRoles(["ROLE_CONSULTANT"])
            // encode the plain password
                ->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            //Important pour la relation OneToOne - Héritage
            $entityManager->persist($consultant);
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addFlash(
                'success',
                'Votre demande a été enregistrée avec succès'
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register_consultant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}