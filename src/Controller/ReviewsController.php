<?php

namespace App\Controller;

use App\Config\ReviewGroup;
use App\Entity\Review;
use App\Entity\User;
use App\Form\ReviewFormType;
use App\Repository\ReviewRepository;
use App\Service\FileUploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reviews", name="reviews_")
 * Class ReviewsController
 * @package App\Controller
 */


class ReviewsController extends AbstractController
{
    /**
     * @Route("/list", name="reviews_list")
     * @param ReviewRepository $reviewRepository
     * @return Response
     */
    public function list(ReviewRepository $reviewRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var User $user */
        $user = $this->getUser();

        $reviews = $reviewRepository->findBy(['author' => $user->getEmail(), 'isDeleted' => false]);
        return $this->render('reviews/list.html.twig', [
            'reviews' => $reviews
        ]);
    }

    /**
     * @Route("/edit/{id}", name="review_edit")
     * @Route("/add", name="review_add")
     * @param Request $request
     * @param Review|null $review
     * @return Response
     */
    public function edit(ManagerRegistry $doctrine, Request $request, FileUploader $fileUploader, Review $review = null): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $entityManager = $doctrine->getManager();
        $form = $this->createForm(ReviewFormType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review = $form->getData();

            //upload cover
            /** @var UploadedFile $cover */
            $cover = $form->get('cover')->getData();
/*            echo "<pre>";
            var_dump($cover); die;*/
            if ($cover) {
                $coverFileName = $fileUploader->upload($cover);
                $review->setCover($coverFileName);
            }

            /** @var UploadedFile $images */
            $images = $form->get('images')->getData();
/*                        echo "<pre>";
            var_dump($images); die;*/
            if ($images) {
                $uploadedFiles = [];
                foreach ($images as $image) {
                    $imageFileName = $fileUploader->upload($image);
                    array_push($uploadedFiles, $imageFileName);
                }
                $review->setImages($uploadedFiles);
            }

            $review->setAuthor($user->getEmail());
            $review->setUsersGrade(0);
            $review->setLikesAmount(0);
            $review->setIsDeleted(false);

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('reviews_reviews_list');
        }
        return $this->renderForm('reviews/edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="review_delete")
     */
    public function delete(ManagerRegistry $doctrine, Review $review): Response
    {
        $entityManager = $doctrine->getManager();

        $review->setIsDeleted(true);
        $entityManager->persist($review);
        $entityManager->flush();

        return $this->redirectToRoute('reviews_reviews_list');
    }

    /**
     * @Route("/show/{id}", name="review_show")
     */
    public function show(Review $review): Response
    {

        return $this->render('reviews/show.html.twig', [
            'review' => $review
        ]);
    }
}


