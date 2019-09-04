<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use App\Repository\MatchsRepository;
use App\Repository\ClassementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompetitionController extends AbstractController
{
    /**
     * @Route("/competition/ligue-1", name="ligue1")
     * * @return Response
     */
    public function ligue1(NewsRepository $repoNews, MatchsRepository $repoMatchs, ClassementRepository $repoClassement): Response
    {       
        $news = $repoNews->findLastFourNews();
        $nextFourMatchs = $repoMatchs->findNextFourMatchs(1);
        $classement = $repoClassement->selectClassement(1);
        return $this->render('competition/ligue1.html.twig', [
         
            'controller_name' => 'ClassementController',
            'news' => $news,
            'NextFourMatchs' => $nextFourMatchs,
            'classement' => $classement,
            'current_menu' => 'classementL1Active'
        ]);
    }

    /**
     * @Route("/competition/ligue-des-champions", name="ligueChampions")
     * * @return Response
     */
    public function ligueChampion(NewsRepository $repoNews, MatchsRepository $repoMatchs, ClassementRepository $repoClassement): Response
    {       
        $news = $repoNews->findLastFourNews();
        $nextFourMatchs = $repoMatchs->findNextFourMatchs(1);
        $classement = $repoClassement->selectClassementLDC(1);
        return $this->render('competition/ligueChampion.html.twig', [
         
            'controller_name' => 'ClassementController',
            'news' => $news,
            'NextFourMatchs' => $nextFourMatchs,
            'classement' => $classement,
            'current_menu' => 'classementLDCActive'
        ]);
    }
}
