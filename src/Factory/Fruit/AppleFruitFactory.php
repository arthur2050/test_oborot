<?php

namespace App\Factory\Fruit;

use App\Entity\Fruit\AbstractFruit;
use App\Entity\Fruit\AppleFruit;
use App\Entity\Tree\AbstractTree;

class AppleFruitFactory implements FruitFactoryInterface{

	public function create(AbstractTree $tree, int $weight): AbstractFruit {
		return new AppleFruit($tree, $weight);
	}

	public function supports(string $treeType): bool
	{
		return $treeType === 'apple';
	}

	public function getRandomWeight(): int
	{
		return rand(150, 180);
	}
}