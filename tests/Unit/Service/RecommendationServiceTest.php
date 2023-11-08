<?php

namespace App\Service;

use App\Enum\RecommendationType;
use PHPUnit\Framework\TestCase;

class RecommendationServiceTest extends TestCase
{
    public function testValidRandomRecommendations()
    {
        $recommendationService = new RecommendationService(
            new DataLoaderService(),
            new RandomRecommendationService(),
            new LetterWEvenCharsRecommendationService(),
            new MultiWordTitlesRecommendationService()
        );

        $recommendations = $recommendationService->generateRecommendations(RecommendationType::RANDOM);

        $this->assertIsArray($recommendations);
        $this->assertCount(3, $recommendations);
    }

    public function testValidLetterWEvenCharsRecommendations()
    {
        $recommendationService = new RecommendationService(
            new DataLoaderService(),
            new RandomRecommendationService(),
            new LetterWEvenCharsRecommendationService(),
            new MultiWordTitlesRecommendationService()
        );

        $recommendations = $recommendationService->generateRecommendations(RecommendationType::LETTER_W_EVEN_CHARS);

        $this->assertIsArray($recommendations);
        $this->assertCount(4, $recommendations);
        $this->assertEqualsCanonicalizing(['Whiplash', 'Wyspa tajemnic', 'Władca Pierścieni: Drużyna Pierścienia', 'Władca Pierścieni: Dwie wieże'], $recommendations);
    }

    public function testValidMultiWordTitlesRecommendations()
    {
        $dataLoaderService = new DataLoaderService();
        $movies = $dataLoaderService->getMovies();

        $recommendationService = new RecommendationService(
            $dataLoaderService,
            new RandomRecommendationService(),
            new LetterWEvenCharsRecommendationService(),
            new MultiWordTitlesRecommendationService()
        );

        $recommendations = $recommendationService->generateRecommendations(RecommendationType::MULTI_WORD_TITLES);

        $expectedCount = count(array_filter($movies, fn ($title) => str_word_count($title) > 1));

        $this->assertIsArray($recommendations);
        $this->assertCount($expectedCount, $recommendations);
    }

    public function testInvalidRecommendationType()
    {
        $recommendationService = new RecommendationService(
            new DataLoaderService(),
            new RandomRecommendationService(),
            new LetterWEvenCharsRecommendationService(),
            new MultiWordTitlesRecommendationService()
        );

        $this->expectException(\InvalidArgumentException::class);
        $recommendationService->generateRecommendations('InvalidType');
    }
}
