<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\BasketWidget;

use Naja\Guide\Domain\Basket\Basket;
use Nette\Application\UI\Control;

/**
 * @property-read BasketWidgetTemplate $template
 */
final class BasketWidgetControl extends Control
{
	public function __construct(
		private Basket $basket,
	) {}

	public function render(): void
	{
		$this->template->setFile(__DIR__ . '/BasketWidgetControl.latte');
		$this->template->itemsCount = $this->basket->countItems();
		$this->template->totalPrice = $this->basket->getTotalPrice();
		$this->template->render();
	}
}
