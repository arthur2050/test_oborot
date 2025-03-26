<?php

namespace App\Factory\Fruit;

use App\Entity\Fruit\AbstractFruit;
use App\Entity\Fruit\PearFruit;
use App\Entity\Tree\AbstractTree;

class PearFruitFactory implements FruitFactoryInterface {

	public function create(AbstractTree $tree, int $weight): AbstractFruit {
		return new PearFruit($tree, $weight);
	}

	public function supports(string $treeType): bool
	{
		return $treeType === 'pear';
	}

	public function getRandomWeight(): int
	{
		return rand(130, 170);
	}
}