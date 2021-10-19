<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Presenters;

use Naja\Guide\Application\UI\Components\AddToBasketButton\AddToBasketButtonControlFactory;
use Naja\Guide\Domain\Basket\Basket;
use Naja\Guide\Domain\Catalog\ProductRepository;
use Nette\Application\UI\Multiplier;

/**
 * @property-read BasketTemplate $template
 */
final class BasketPresenter extends BasePresenter
{
	public function __construct(
		private Basket $basket,
		private ProductRepository $productRepository,
		private AddToBasketButtonControlFactory $addToBasketButtonControlFactory,
	)
	{
		parent::__construct();
	}

	public function renderDefault(): void
	{
		$this->template->setFile(__DIR__ . '/Basket.latte');
		$this->template->totalPrice = $this->basket->getTotalPrice();
		$this->template->items = $this->basket->getItems();
	}

	protected function createComponentAddToBasket(): Multiplier
	{
		return new Multiplier(
			function (string $productId) {
				$product = $this->productRepository->getById((int) $productId);
				$component = $this->addToBasketButtonControlFactory->create($product);
				$component->onChange[] = fn() => $this->redirect('this');

				return $component;
			},
		);
	}
}
