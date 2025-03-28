<?php

namespace App\Entity\Fruit;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class AppleFruit extends AbstractFruit
{
	/**
	 * @var int
	 */
	#[Assert\Range(min: 150, max: 180, notInRangeMessage: "Вес яблока должен быть от 150 до 180 грамм.")]
	protected int $weight;
}