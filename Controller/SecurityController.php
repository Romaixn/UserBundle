<?php

namespace Rherault\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SecurityController extends AbstractController
{
  /**
   * @Route("/login", name="rherault_userbundle_login")
   *
   * @param AuthenticationUtils $authenticationUtils
   *
   * @return Response
   */
  public function login(AuthenticationUtils $authenticationUtils): Response
  {
    $error = $authenticationUtils->getLastAuthenticationError();

    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('security/login.html.twig', [
      'last_username' => $lastUsername,
      'error' => $error
    ]);
  }


  /**
   * @Route("/register", name="rherault_userbundle_register")
   *
   * @param Request $request 
   * @param UserPasswordEncoderInterface $passwordEncoder 
   *
   * @return RedirectResponse|Response
   */
  public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder) : Response 
  {
    if($request->isMethod('POST')) {
      $user = new User();

      $user->setUsername($request->request->get('username'));
      $user->setEmail($request->request->get('email'));
      $user->setName($request->request->get('name'));
      $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      return $this->redirectToRoute('index');
    }

    return $this->render('security/register.html.twig');
  }
}
