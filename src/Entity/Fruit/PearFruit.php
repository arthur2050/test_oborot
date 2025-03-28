<?php

namespace App\Entity\Fruit;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class PearFruit extends AbstractFruit
{
	/**
	 * @var int
	 */
	#[Assert\Range(min: 130, max: 170, notInRangeMessage: "Вес груши должен быть от 130 до 170 грамм.")]
	protected int $weight;
}