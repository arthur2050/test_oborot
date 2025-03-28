<?php

namespace App\Factory\Tree;

use App\Entity\Tree\AbstractTree;
use App\Entity\Tree\PearTree;

class PearTreeFactory implements TreeFactoryInterface
{
	/**
	 * @return AbstractTree
	 */
	public function create(): AbstractTree
	{
		$pearTree = new PearTree();
		$pearTree->setRegId($this->generateRegId());
		return $pearTree;
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