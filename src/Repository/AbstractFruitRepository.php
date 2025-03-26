<?php

namespace App\Repository;

use App\Entity\Fruit\AbstractFruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AbstractFruitRepository extends ServiceEntityRepository
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, AbstractFruit::class);
	}

	/**
	 * Получает самый тяжелый плод для заданного типа дерева (например, 'apple' или 'pear')
	 */
	public function findHeaviestFruitByTreeType(string $treeType): ?array
	{
		return $this->createQueryBuilder('f')
			->join('f.tree', 't')
			->where('t.type = :treeType')
			->setParameter('treeType', $treeType)
			->orderBy('f.weight', 'DESC')
			->setMaxResults(1)
			->select('f.weight, IDENTITY(f.tree) as treeId')
			->getQuery()
			->getOneOrNullResult();
	}
}