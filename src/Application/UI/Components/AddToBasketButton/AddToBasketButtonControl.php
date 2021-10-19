<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\AddToBasketButton;

use Naja\Guide\Domain\Basket\Basket;
use Naja\Guide\Domain\Catalog\Product;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

/**
 * @property-read AddToBasketButtonTemplate $template
 * @method void onChange()
 */
final class AddToBasketButtonControl extends Control
{
	/** @var callable[] */
	public array $onChange = [];

	public function __construct(
		private Product $product,
		private Basket $basket,
	) {}

	public function render(): void
	{
		$this->template->setFile(__DIR__ . '/AddToBasketButtonControl.latte');
		$this->template->item = $this->basket->getItem($this->product);
		$this->template->render();
	}

	public function handleAdd(): void
	{
		$this->basket->add($this->product);
		$this->onChange();
	}

	protected function createComponentForm(): Form
	{
		$form = new Form();

		$subtract = $form->addSubmit('subtract', '–');
		$subtract->onClick[] = function (): void {
			$this->basket->subtract($this->product);
			$this->onChange();
		};

		$add = $form->addSubmit('add', '+');
		$add->onClick[] = function (): void {
			$this->basket->add($this->product);
			$this->onChange();
		};

		return $form;
	}
}
