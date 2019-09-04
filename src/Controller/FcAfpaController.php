<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\NewsRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MatchsRepository;

class FcAfpaController extends AbstractController
{
   /**
     * @Route("/", name="home")
     * * @return Response
     */
    public function index(NewsRepository $repo, MatchsRepository $repoMatchs): Response
    {
        if($user = $this->getUser())
            {
                if($user->getIsValid() == 0)
                {
                    return $this->redirectToRoute('deconnexion');
                }
            }

        $nextMatch = $repoMatchs->findNextMatch(1);
        $news = $repo->findLastFourNews();
        $oneNews = $repo->findTheLastOneNews();
        $LastMatch = $repoMatchs->findLastMatch(1);
        $LastFourMatchs = $repoMatchs->findLastFourMatchs(1);

        return $this->render('fc_afpa/home.html.twig', [
                'news' => $news,
                'lastNews' => $oneNews,
                'LastMatch' => $LastMatch,
                'LastFourMatchs' => $LastFourMatchs,
                'current_menu' => 'accueilActive',
                'nextMatch' => $nextMatch
        ]);
    }
}

