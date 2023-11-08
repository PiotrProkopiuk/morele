<?php

namespace App\Controller;

use App\Service\LetterWEvenCharsRecommendationService;
use App\Service\MultiWordTitlesRecommendationService;
use App\Service\RandomRecommendationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MovieRecommendationController extends AbstractController
{

    #[Route('/recommendations/random', name: 'movie_recommendations_random')]
    public function randomRecommendations(RandomRecommendationService $randomRecommendationService): JsonResponse
    {
        return new JsonResponse($randomRecommendationService->generateRandomRecommendations());
    }

    #[Route('/recommendations/letter-w-even-chars', name: 'movie_recommendations_letter_w_even_chars')]
    public function letterWEvenCharsRecommendations(LetterWEvenCharsRecommendationService $letterWEvenCharsRecommendationService): JsonResponse
    {
        return new JsonResponse($letterWEvenCharsRecommendationService->generateLetterWEvenCharsRecommendations());
    }

    #[Route('/recommendations/multi-word-titles', name: 'movie_recommendations_multi_word_titles')]
    public function multiWordTitlesRecommendations(MultiWordTitlesRecommendationService $multiWordTitlesRecommendationService): JsonResponse
    {
        return new JsonResponse($multiWordTitlesRecommendationService->generateMultiWordTitlesRecommendations());
    }
}
