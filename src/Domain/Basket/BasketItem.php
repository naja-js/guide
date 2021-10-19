<?php

declare(strict_types=1);

namespace Naja\Guide\Domain\Basket;

use Brick\Math\BigInteger;
use Naja\Guide\Domain\Catalog\Product;

final class BasketItem
{
	public function __construct(
		public Product $product,
		public BigInteger $amount,
	) {}
}
