<?php

namespace App\Entity\Tree;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PearTree extends AbstractTree
{
	public static function getMinFruits(): int
	{
		return 0;
	}

	public static function getMaxFruits(): int
	{
		return 20;
	}
}