<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use App\Repository\MatchsRepository;
use App\Repository\ClassementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassementController extends AbstractController
{
    /**
     * @Route("/classement", name="classement")
     * * @return Response
     */
    public function index(NewsRepository $repoNews, MatchsRepository $repoMatchs, ClassementRepository $repoClassement): Response
    {       
        $news = $repoNews->findLastFourNews();
        $nextFourMatchs = $repoMatchs->findNextFourMatchs(1);
        $classement = $repoClassement->selectClassement(1);
        return $this->render('classement/classement.html.twig', [
         
            'controller_name' => 'ClassementController',
            'news' => $news,
            'NextFourMatchs' => $nextFourMatchs,
            'classement' => $classement,
            'current_menu' => 'classementActive'
        ]);
    }
}
