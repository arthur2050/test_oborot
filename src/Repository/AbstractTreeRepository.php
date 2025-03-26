<?php

namespace App\Repository;

use App\Entity\Tree\AbstractTree;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AbstractTreeRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AbstractTree::class);
	}

	/**
	 * Собирает все плоды с деревьев и возвращает общее количество плодов для каждого типа дерева
	 *
	 * @return array
	 */
	public function countFruitsForEachTreeType(): array
	{
		$trees = $this->createQueryBuilder('t')
			->select('t.type, COUNT(f) AS fruitCount') // Считаем количество плодов
			->leftJoin('t.fruits', 'f') // Делаем join с плодами
			->groupBy('t.type') // Группируем по типу дерева
			->getQuery()
			->getResult();

		// Возвращаем массив с типами деревьев и количеством плодов для каждого
		return $trees;
	}


	/**
	 * Собирает общий вес плодов для каждого типа дерева
	 *
	 * @return array
	 */
	public function countTotalWeightForEachTreeType(): array
	{
		$trees = $this->createQueryBuilder('t')
			->select('t.type, SUM(f.weight) AS totalWeight') // Суммируем вес плодов
			->leftJoin('t.fruits', 'f') // Делаем join с плодами
			->groupBy('t.type') // Группируем по типу дерева
			->getQuery()
			->getResult();

		// Возвращаем массив с типами деревьев и суммарным весом плодов для каждого
		return $trees;
	}
}