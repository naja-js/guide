<?php

declare(strict_types=1);

namespace Naja\Guide\Domain\Catalog;

use Brick\Money\Money;
use function array_filter;
use function array_values;

final class ProductRepository
{
	/** @var Product[] */
	private array $products;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$categories = [
			'arabica' => $categoryRepository->getBySlug('arabica'),
			'robusta' => $categoryRepository->getBySlug('robusta'),
			'blend' => $categoryRepository->getBySlug('blend'),
		];

		$this->products = [
			1  => new Product(1, $categories['arabica'], 'Brasil Santos 250g', 'A well-balanced coffee, sweet with a taste of chocolate and a hint of caramel.', '/assets/images/brasil.svg', Money::of(11.99, 'USD')),
			2  => new Product(2, $categories['arabica'], 'Brasil Santos 500g', 'A well-balanced coffee, sweet with a taste of chocolate and a hint of caramel.', '/assets/images/brasil.svg', Money::of(20.99, 'USD')),
			3  => new Product(3, $categories['arabica'], 'Ethiopia Honey 250g', 'A delicate coffee with a juicy body and lightly acidic, citric flavours.', '/assets/images/ethiopia.svg', Money::of(11.49, 'USD')),
			4  => new Product(4, $categories['arabica'], 'Ethiopia Honey 500g', 'A delicate coffee with a juicy body and lightly acidic, citric flavours.', '/assets/images/ethiopia.svg', Money::of(19.99, 'USD')),
			5  => new Product(5, $categories['robusta'], 'India Cherry Robusta 250g', 'A bitter, coarse coffee with a full earthy profile and a touch of cherries.', '/assets/images/india.svg', Money::of(8.49, 'USD')),
			6  => new Product(6, $categories['robusta'], 'India Cherry Robusta 500g', 'A bitter, coarse coffee with a full earthy profile and a touch of cherries.', '/assets/images/india.svg', Money::of(14.99, 'USD')),
			7  => new Product(7, $categories['blend'], 'Sweet Blend 250g', 'A perfect mixture of arabicas and robustas for those who prefer sweeter tastes.', '/assets/images/sweet.svg', Money::of(10.99, 'USD')),
			8  => new Product(8, $categories['blend'], 'Sweet Blend 500g', 'A perfect mixture of arabicas and robustas for those who prefer sweeter tastes.', '/assets/images/sweet.svg', Money::of(18.99, 'USD')),
			9  => new Product(9, $categories['blend'], 'Bitter Blend 250g', 'A perfect mixture of arabicas and robustas for those who prefer more bitter tastes.', '/assets/images/bitter.svg', Money::of(9.99, 'USD')),
			10 => new Product(10, $categories['blend'], 'Bitter Blend 500g', 'A perfect mixture of arabicas and robustas for those who prefer more bitter tastes.', '/assets/images/bitter.svg', Money::of(17.99, 'USD')),
			11 => new Product(11, $categories['blend'], 'CodinGrains Blend 250g', 'Our special blend of grains carefully selected to boost your coding productivity.', '/assets/images/trademark.svg', Money::of(10.99, 'USD')),
			12 => new Product(12, $categories['blend'], 'CodinGrains Blend 500g', 'Our special blend of grains carefully selected to boost your coding productivity.', '/assets/images/trademark.svg', Money::of(21.99, 'USD')),
		];
	}

	/**
	 * @return Product[]
	 */
	public function findAll(): array
	{
		return array_values($this->products);
	}

	public function findByCategory(Category $category): array
	{
		return array_filter(
			array_values($this->products),
			static fn(Product $product) => $product->getCategory() === $category,
		);
	}

	public function getById(int $id): Product
	{
		return $this->products[$id] ?? throw new \Exception('Product not found.');
	}
}
