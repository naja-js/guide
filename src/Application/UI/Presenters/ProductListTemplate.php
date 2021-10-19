<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Presenters;

use Naja\Guide\Application\UI\BaseTemplate;
use Naja\Guide\Domain\Catalog\Product;

final class ProductListTemplate extends BaseTemplate
{
	/** @var Product[] */
	public array $products;
}
