<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        //formos buildinimas
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        //handle the submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            //encode the password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setRoles('ROLE_USER');

            //save the user
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            //flash message (add in future)

            return $this->redirectToRoute('index');
        }

        return $this->render(
            'registration/register.html.twig', [
                'form' => $form->createView()
        ]);
    }
}