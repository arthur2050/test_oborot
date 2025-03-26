<?php

namespace App\Factory\Fruit;

use App\Entity\Fruit\AbstractFruit;
use App\Entity\Tree\AbstractTree;

interface FruitFactoryInterface {
	public function create(AbstractTree $tree, int $weight): AbstractFruit;
	public function supports(string $treeType): bool;
	public function getRandomWeight(): int;
}