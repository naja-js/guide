<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Presenters;

use Brick\Money\Money;
use Naja\Guide\Application\UI\BaseTemplate;
use Naja\Guide\Domain\Basket\BasketItem;

final class BasketTemplate extends BaseTemplate
{
	public Money $totalPrice;

	/** @var BasketItem[] */
	public array $items;
}
