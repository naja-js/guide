<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\Reviews;

use Naja\Guide\Domain\Catalog\Product;

interface ReviewsControlFactory
{
	public function create(Product $product): ReviewsControl;
}
