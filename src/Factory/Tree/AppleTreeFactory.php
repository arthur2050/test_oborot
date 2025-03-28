<?php

namespace App\Factory\Tree;

use App\Entity\Tree\AbstractTree;
use App\Entity\Tree\AppleTree;

class AppleTreeFactory implements TreeFactoryInterface
{
	/**
	 * @return AbstractTree
	 */
	public function create(): AbstractTree
	{
		$appleTree = new AppleTree();
		$appleTree->setRegId($this->generateRegId());
		return $appleTree;
	}

	/**
	 * @return int
	 *
	 * @throws \Random\RandomException
	 */
	private function generateRegId(): int
	{
		return random_int(1_000_000_000_000_000, 9_999_999_999_999_999);
	}
}
