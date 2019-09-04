<?php

namespace App\Controller;

use App\Repository\StaffRepository;
use App\Repository\JoueurRepository;
use App\Repository\SaisonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index(JoueurRepository $repoJoueur, StaffRepository $repoStaff, SaisonRepository $repoSaison)
    {
        $saisons = $repoSaison->findAll();
        $staffModal = $repoStaff->findAll();
        $joueurModal = $repoJoueur->FindJoueurById(1);
        return $this->render('about/about.html.twig', [
            'current_menu' => 'aboutActive', 
            'joueurModalShow' => $joueurModal,
            'staffModalShow' => $staffModal,
            'saisons' => $saisons
        ]);
    }
}
