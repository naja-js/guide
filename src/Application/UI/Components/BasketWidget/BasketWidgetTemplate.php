<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\BasketWidget;

use Brick\Money\Money;
use Naja\Guide\Application\UI\BaseTemplate;

final class BasketWidgetTemplate extends BaseTemplate
{
	public int $itemsCount;
	public Money $totalPrice;
}
