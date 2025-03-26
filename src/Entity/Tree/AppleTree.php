<?php

namespace App\Entity\Tree;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class AppleTree extends AbstractTree
{
	public static function getMinFruits(): int
	{
		return 40;
	}

	public static function getMaxFruits(): int
	{
		return 50;
	}
}