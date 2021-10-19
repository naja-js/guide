<?php

declare(strict_types=1);

namespace Naja\Guide\Domain\Catalog;

use function array_values;

final class CategoryRepository
{
	/** @var Category[] */
	private array $categories;

	public function __construct()
	{
		$this->categories = [
			'arabica' => new Category('arabica', 'Arabica'),
			'robusta' => new Category('robusta', 'Robusta'),
			'blend' => new Category('blend', 'Blend'),
		];
	}

	/**
	 * @return Category[]
	 */
	public function findAll(): array
	{
		return array_values($this->categories);
	}

	public function getBySlug(string $slug): Category
	{
		return $this->categories[$slug] ?? throw new \Exception('Category not found.');
	}
}
