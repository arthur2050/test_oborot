<?php

namespace App\Factory\Fruit;

use App\Entity\Fruit\AbstractFruit;
use App\Entity\Tree\AbstractTree;

interface FruitFactoryInterface
{
	/**
	 * @param AbstractTree $tree
	 * @param int $weight
	 *
	 * @return AbstractFruit
	 */
	public function create(AbstractTree $tree, int $weight): AbstractFruit;

	/**
	 * @param string $treeType
	 *
	 * @return bool
	 */
	public function supports(string $treeType): bool;

	/**
	 * @return int
	 */
	public function getRandomWeight(): int;
}