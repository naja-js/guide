<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Presenters;

use Naja\Guide\Application\UI\Components\AddToBasketButton\AddToBasketButtonControl;
use Naja\Guide\Application\UI\Components\AddToBasketButton\AddToBasketButtonControlFactory;
use Naja\Guide\Application\UI\Components\Reviews\ReviewsControl;
use Naja\Guide\Application\UI\Components\Reviews\ReviewsControlFactory;
use Naja\Guide\Domain\Catalog\Product;
use Naja\Guide\Domain\Catalog\ProductRepository;

/**
 * @property-read ProductDetailTemplate $template
 */
final class ProductDetailPresenter extends BasePresenter
{
	private Product $product;

	public function __construct(
		private ProductRepository $productRepository,
		private AddToBasketButtonControlFactory $addToBasketButtonControlFactory,
		private ReviewsControlFactory $reviewsControlFactory,
	)
	{
		parent::__construct();
	}

	public function actionDefault(int $id): void
	{
		try {
			$this->product = $this->productRepository->getById($id);
		} catch (\Throwable) {
			$this->error();
		}
	}

	public function renderDefault(): void
	{
		$this->template->setFile(__DIR__ . '/ProductDetail.latte');
		$this->template->product = $this->product;
	}

	protected function createComponentAddToBasket(): AddToBasketButtonControl
	{
		$component = $this->addToBasketButtonControlFactory->create($this->product);
		$component->onChange[] = fn() => $this->redirect('this');

		return $component;
	}

	protected function createComponentReviews(): ReviewsControl
	{
		return $this->reviewsControlFactory->create($this->product);
	}
}
