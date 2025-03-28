<?php

namespace App\Entity\Tree;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AppleTree extends AbstractTree
{
	/**
	 * @return int
	 */
	public static function getMinFruits(): int
	{
		return 40;
	}

	/**
	 * @return int
	 */
	public static function getMaxFruits(): int
	{
		return 50;
	}
}