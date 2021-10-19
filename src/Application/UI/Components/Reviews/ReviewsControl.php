<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\Reviews;

use Naja\Guide\Domain\Catalog\Product;
use Nette\Application\UI\Control;

/**
 * @property-read ReviewsTemplate $template
 */
final class ReviewsControl extends Control
{
	public function __construct(
		private Product $product,
	) {}

	public function render(): void
	{
		$this->template->setFile(__DIR__ . '/ReviewsControl.latte');
		$this->template->productId = $this->product->getId();
		$this->template->render();
	}
}
