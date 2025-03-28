<?php

namespace App\DataFixtures;

use App\Factory\Tree\TreeFactoryInterface;
use App\Factory\Fruit\FruitFactoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
	/**
	 * @param TreeFactoryInterface[] $treeFactories
	 * @param FruitFactoryInterface[] $fruitFactories
	 */
	public function __construct(
		private iterable $treeFactories,  // Фабрики деревьев
		private iterable $fruitFactories,  // Фабрики фруктов
		private int      $treeCountPerType
	)
	{
	}

	/**
	 * @param ObjectManager $manager
	 * @return void
	 */
	public function load(ObjectManager $manager): void
	{
		$trees = [];

		// Генерация деревьев (10 каждого типа)
		foreach ($this->treeFactories as $treeFactory) {
			for ($i = 0; $i < $this->treeCountPerType; $i++) { // Количество можно легко изменить
				$tree = $treeFactory->create();
				$manager->persist($tree);
				$trees[] = $tree;
			}
		}

		$manager->flush();
		// Добавление фруктов к деревьям
		foreach ($trees as $tree) {
			$treeType = strtolower(trim($tree->getType()));

			// Найдём соответствующую фабрику фруктов по типу дерева
			$fruitFactory = null;
			foreach ($this->fruitFactories as $factory) {
				if ($factory->supports($treeType)) {
					$fruitFactory = $factory;
					break;
				}
			}

			if (!$fruitFactory) {
				continue; // Если нет фабрики для этого дерева, пропускаем
			}

			$fruitCount = rand($tree->getMinFruits(), $tree->getMaxFruits());

			for ($i = 0; $i < $fruitCount; $i++) {
				$weight = $fruitFactory->getRandomWeight();
				$fruit = $fruitFactory->create($tree, $weight);
				$fruit->setTree($tree);
				$manager->persist($fruit);
			}
		}

		$manager->flush();
	}
}
