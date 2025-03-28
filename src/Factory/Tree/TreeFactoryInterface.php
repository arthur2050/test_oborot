<?php

namespace App\Factory\Tree;

use App\Entity\Tree\AbstractTree;

interface TreeFactoryInterface
{
	/**
	 * @return AbstractTree
	 */
	public function create(): AbstractTree;
}