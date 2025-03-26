<?php

namespace App\Entity\Fruit;

use App\Entity\Tree\AbstractTree;
use App\Repository\AbstractFruitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AbstractFruitRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
abstract class AbstractFruit
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	protected int $id;

	#[ORM\ManyToOne(targetEntity: AbstractTree::class, inversedBy: 'fruits')]
	#[ORM\JoinColumn(nullable: false)]
	protected AbstractTree $tree;

	#[ORM\Column(type: 'integer')]
	#[Assert\Range(min: 130, max: 180)]
	protected int $weight;

	public function __construct(AbstractTree $tree, int $weight)
	{
		$this->tree = $tree;
		$this->weight = $weight;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getTree(): AbstractTree
	{
		return $this->tree;
	}

	public function setTree(AbstractTree $tree): self {
		$this->tree = $tree;

		return $this;
	}

	public function getWeight(): int
	{
		return $this->weight;
	}
}