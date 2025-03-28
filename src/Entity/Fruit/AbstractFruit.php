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
	/**
	 * @var int
	 */
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	protected int $id;

	/**
	 * @var AbstractTree
	 */
	#[ORM\ManyToOne(targetEntity: AbstractTree::class, inversedBy: 'fruits')]
	#[ORM\JoinColumn(nullable: false)]
	protected AbstractTree $tree;

	/**
	 * @var int
	 */
	#[ORM\Column(type: 'integer')]
	#[Assert\Range(min: 130, max: 180)]
	protected int $weight;

	/**
	 * @param AbstractTree $tree
	 * @param int $weight
	 */
	public function __construct(AbstractTree $tree, int $weight)
	{
		$this->tree = $tree;
		$this->weight = $weight;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return AbstractTree
	 */
	public function getTree(): AbstractTree
	{
		return $this->tree;
	}

	/**
	 * @param AbstractTree $tree
	 * @return AbstractFruit
	 */
	public function setTree(AbstractTree $tree): self
	{
		$this->tree = $tree;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getWeight(): int
	{
		return $this->weight;
	}
}