<?php

namespace App\Helpers\Fruit;

use App\Repository\AbstractTreeRepository;

class FruitCounter implements FruitCounterInterface
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
		// Получаем данные о количестве плодов для каждого типа дерева
		return $this->treeRepository->countFruitsForEachTreeType();
	}
}