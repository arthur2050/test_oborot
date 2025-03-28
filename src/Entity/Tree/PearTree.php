<?php

namespace App\Entity\Tree;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PearTree extends AbstractTree
{
	/**
	 * @return int
	 */
	public static function getMinFruits(): int
	{
		return 0;
	}

	/**
	 * @return int
	 */
	public static function getMaxFruits(): int
	{
		return 20;
	}
}