<?php

namespace App\Helpers\Fruit;

use App\Repository\AbstractTreeRepository;

class FruitWeightCounter implements FruitCounterInterface
{

	/**
	 * @param AbstractTreeRepository $treeRepository
	 */
	public function __construct(private readonly AbstractTreeRepository $treeRepository)
	{
	}

	/**
	 * @return array
	 */
	public function count(): array
	{
		// Получаем общий вес плодов для каждого типа дерева
		return $this->treeRepository->countTotalWeightForEachTreeType();
	}
}