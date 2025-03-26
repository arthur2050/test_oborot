<?php

namespace App\Helpers\Fruit;

use App\Repository\AbstractTreeRepository;

class FruitCounter implements FruitCounterInterface {
	public function __construct( private readonly AbstractTreeRepository $treeRepository)
	{
	}

	public function count(): array {
		// Получаем данные о количестве плодов для каждого типа дерева
		return $this->treeRepository->countFruitsForEachTreeType();
	}
}