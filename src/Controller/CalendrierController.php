<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use App\Repository\MatchsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CalendrierController extends AbstractController
{
     /**
     * @Route("/calendrier", name="calendrier")
     */
    public function index(MatchsRepository $repo, NewsRepository $repoNews)
    {
        $matchs = $repo->findByIdEquipe(1);
        $nextmatch = $repo->findNextMatch(1);
        $news = $repoNews->findLastFourNews(1);
        return $this->render('calendrier/calendrier.html.twig', [            
                'last_news' => $news,
                'matchs' => $matchs,
                'nextmatch' => $nextmatch,
                'current_menu' => 'calendrierActive'
        ]);
    }
}
