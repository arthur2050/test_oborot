<?php

namespace App\Factory\Tree;

use App\Entity\Tree\AbstractTree;
use App\Entity\Tree\AppleTree;

class AppleTreeFactory implements TreeFactoryInterface
{
	public function create(): AbstractTree
	{
		$appleTree = new AppleTree();
		$appleTree->setRegId($this->generateRegId());
		return $appleTree;
	}

	private function generateRegId(): int
	{
		return random_int(1_000_000_000_000_000, 9_999_999_999_999_999);
	}
}
