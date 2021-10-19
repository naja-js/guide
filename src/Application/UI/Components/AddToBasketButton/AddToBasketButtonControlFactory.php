<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\AddToBasketButton;

use Naja\Guide\Domain\Catalog\Product;

interface AddToBasketButtonControlFactory
{
	public function create(Product $product): AddToBasketButtonControl;
}
