<?php

namespace App\Controller;


use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use App\Entity\PasswordUpdate;

class SecurityController extends Controller
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
    $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user->setDateInscription(new \DateTime);
            $user->setRoles(['ROLE_USER']);
            $user->setIsValid(true);

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'notice',
                'Inscription réussie ! Vous pouvez maintenant vous connecter !'
            );
            return $this->redirectToRoute('home');
        } 
    
       
        
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

     /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword( Request $request,UserPasswordEncoderInterface $encoder,\Swift_Mailer $mailer,TokenGeneratorInterface $tokenGenerator)
    {
 
        if ($request->isMethod('POST')) {
 
            $email = $request->request->get('email');
 
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(Utilisateur::class)->findOneByEmailUtilisateur($email);
            /* @var $user User */
 
            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('home');
            }
            $token = $tokenGenerator->generateToken();
 
            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }
 
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
 
            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('testsymfony4tc@gmail.com')
                ->setTo($user->getEmailUtilisateur())
                ->setBody(
                    "Voici le lien pour réinitialiser votre mot de passe " . $url,
                    'text/html'
                );
 
            $mailer->send($message);
 
            $this->addFlash('notice', 'Mail envoyé');
 
            return $this->redirectToRoute('home');
        }
 
        return $this->render('security/forgotten_password.html.twig');
    }

    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(Utilisateur::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('home');
            }

            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();

            $this->addFlash('notice', 'Mot de passe mis à jour');

            return $this->redirectToRoute('home');
        }else {

            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }

    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion() {

        return $this->render('security/connexion.html.twig');
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion() {
     
        return $this->render('fc_afpa/home.html.twig');
        
    }

    /**
     * @Route("account/password_change", name="account_password")
     * 
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager) {

        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
              // Verify password with old passwod databse
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){

                $this->addFlash(
                    'error',
                    'L\'ancien mot de passe ne correspond pas'
                );

            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($hash);
                $manager->persist($user);
                $manager->flush();

                
                $this->addFlash(
                    'notice',
                    'Votre mot de passe a bien été modifié !'
                );
                 return $this->redirectToRoute('home');
            
            }
          
        }

        return $this->render('security/change_password.html.twig', ['form' => $form->createView()]);
    }
}
