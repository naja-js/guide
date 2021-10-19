<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\AddToBasketButton;

use Latte\Attributes\TemplateFunction;
use Naja\Guide\Application\UI\BaseTemplate;
use Naja\Guide\Domain\Basket\BasketItem;

final class AddToBasketButtonTemplate extends BaseTemplate
{
	public BasketItem|null $item;

	#[TemplateFunction]
	public function hasItem(): bool
	{
		return $this->item !== null;
	}
}
