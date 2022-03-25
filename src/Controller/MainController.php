<?php

namespace App\Controller;

use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(ReviewRepository $reviewRepository): Response
    {
        $lastReviews = $reviewRepository->findBy(['isDeleted' => false], ['id' => 'DESC'], 6, 0);
        $popularReviews = $reviewRepository->findByLikesAmount();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'lastReviews' => $lastReviews,
            'popularReviews' => $popularReviews
        ]);
    }
}
