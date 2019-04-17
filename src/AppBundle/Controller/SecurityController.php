<?php

namespace AppBundle\Controller;

use AppBundle\Form\LoginForm;
use AppBundle\Form\RegisterForm;
use AppBundle\Security\RegisterUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction()
    {
        $form = $this->createForm(LoginForm::class);

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/registration", name="security_register")
     */
    public function registerAction(Request $request, RegisterUser $registerUser)
    {
        $form = $this->createForm(RegisterForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registerUser->register($form->getData());
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}