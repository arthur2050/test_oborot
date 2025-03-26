<?php

namespace App\Entity\Tree;

use App\Entity\Fruit\AbstractFruit;
use App\Repository\AbstractTreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbstractTreeRepository::class )]
#[ORM\InheritanceType('SINGLE_TABLE')]
abstract class AbstractTree
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	protected int $id;


	#[ORM\Column(type: 'string')]
	protected string $type;

	#[ORM\Column(type: 'bigint', unique: true)]
	protected int $regId;

	#[ORM\OneToMany(mappedBy: 'tree', targetEntity: AbstractFruit::class, cascade: ['persist', 'remove'])]
	protected Collection $fruits;

	public function __construct()
	{
		$this->setTypeFromClass();
		$this->fruits = new ArrayCollection();
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getRegId(): int
	{
		return $this->regId;
	}

	public function setRegId(int $regId): self
	{
		$this->regId = $regId;

		return $this;
	}

	// Геттер для поля 'type'
	public function getType(): string
	{
		return $this->type;
	}

	// Устанавливаем тип дерева при создании объекта
	private function setTypeFromClass(): void
	{
		$this->type = strtolower(str_replace('Tree', '', basename(str_replace('\\', '/', static::class))));
	}

	abstract public static function getMinFruits(): int;
	abstract public static function getMaxFruits(): int;
}