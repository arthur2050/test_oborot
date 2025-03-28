<?php

namespace App\Entity\Tree;

use App\Entity\Fruit\AbstractFruit;
use App\Repository\AbstractTreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbstractTreeRepository::class)]
#[ORM\InheritanceType('SINGLE_TABLE')]
abstract class AbstractTree
{
	/**
	 * @var int
	 */
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	protected int $id;

	/**
	 * @var string
	 */
	#[ORM\Column(type: 'string')]
	protected string $type;

	/**
	 * @var int
	 */
	#[ORM\Column(type: 'bigint', unique: true)]
	protected int $regId;

	/**
	 * @var Collection|ArrayCollection
	 */
	#[ORM\OneToMany(mappedBy: 'tree', targetEntity: AbstractFruit::class, cascade: ['persist', 'remove'])]
	protected Collection $fruits;

	public function __construct()
	{
		$this->setTypeFromClass();
		$this->fruits = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return int
	 */
	public function getRegId(): int
	{
		return $this->regId;
	}

	/**
	 * @param int $regId
	 *
	 * @return AbstractTree
	 */
	public function setRegId(int $regId): self
	{
		$this->regId = $regId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	//

	/**
	 * Устанавливаем тип дерева при создании объекта
	 *
	 * @return void
	 */
	private function setTypeFromClass(): void
	{
		$this->type = strtolower(str_replace('Tree', '', basename(str_replace('\\', '/', static::class))));
	}

	/**
	 * @return int
	 */
	abstract public static function getMinFruits(): int;

	/**
	 * @return int
	 */
	abstract public static function getMaxFruits(): int;
}