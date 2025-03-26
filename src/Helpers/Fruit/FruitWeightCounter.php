<?php

namespace App\Helpers\Fruit;

use App\Repository\AbstractTreeRepository;

class FruitWeightCounter implements FruitCounterInterface{
	public function __construct( private readonly AbstractTreeRepository $treeRepository)
	{
	}

	public function count(): array {
		// Получаем общий вес плодов для каждого типа дерева
		return $this->treeRepository->countTotalWeightForEachTreeType();
	}
}