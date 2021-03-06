<?php

declare(strict_types=1);

namespace Naja\Guide\Domain\Catalog;

use Brick\Money\Money;

final class Product
{
	public function __construct(
		private int $id,
		private Category $category,
		private string $name,
		private string $description,
		private string $imageUrl,
		private Money $price,
	) {}

	public function getId(): int
	{
		return $this->id;
	}

	public function getCategory(): Category
	{
		return $this->category;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function getImageUrl(): string
	{
		return $this->imageUrl;
	}

	public function getPrice(): Money
	{
		return $this->price;
	}
}
