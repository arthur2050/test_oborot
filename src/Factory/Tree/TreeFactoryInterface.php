<?php

namespace App\Factory\Tree;

use App\Entity\Tree\AbstractTree;

interface TreeFactoryInterface {
	public function create(): AbstractTree;
}