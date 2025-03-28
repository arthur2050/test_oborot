<?php

namespace App\Controller;

use App\Repository\AbstractFruitRepository;
use App\Repository\AbstractTreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class GardenController extends AbstractController
{

	/**
	 * @param AbstractTreeRepository $treeRepository
	 * @param AbstractFruitRepository $fruitRepository
	 * @return Response
	 */
	#[Route('/garden/index', name: 'garden.index', methods: ['GET'])]
	public function index(
		AbstractTreeRepository  $treeRepository,
		AbstractFruitRepository $fruitRepository
	): Response
	{
		// Количество фруктов каждого типа
		$fruitCounts = $treeRepository->countFruitsForEachTreeType();

		// Общий вес фруктов каждого типа
		$fruitWeights = $treeRepository->countTotalWeightForEachTreeType();

		// Самое тяжелое яблоко
		$heaviestApple = $fruitRepository->findHeaviestFruitByTreeType('apple');

		return $this->render('garden_index.html.twig', [
			'fruitCounts' => $fruitCounts,
			'fruitWeights' => $fruitWeights,
			'heaviestApple' => $heaviestApple,
		]);
	}
}