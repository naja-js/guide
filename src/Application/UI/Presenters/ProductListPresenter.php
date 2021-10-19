<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Presenters;

use Naja\Guide\Application\UI\Components\CategoryFilter\CategoryFilterControl;
use Naja\Guide\Application\UI\Components\CategoryFilter\CategoryFilterControlFactory;
use Naja\Guide\Application\UI\Components\Paging\PagingControl;
use Naja\Guide\Application\UI\Components\Paging\PagingControlFactory;
use Naja\Guide\Domain\Catalog\Product;
use Naja\Guide\Domain\Catalog\ProductRepository;
use function array_filter;
use function array_slice;
use function count;

/**
 * @property-read ProductListTemplate $template
 */
final class ProductListPresenter extends BasePresenter
{
	private const PER_PAGE = 5;

	public function __construct(
		private ProductRepository $productRepository,
		private CategoryFilterControlFactory $categoryFilterControlFactory,
		private PagingControlFactory $pagingControlFactory,
	)
	{
		parent::__construct();
	}

	public function renderDefault(): void
	{
		$products = $this->productRepository->findAll();

		$category = $this['categoryFilter']->getSelectedCategory();
		if ($category !== null) {
			$products = array_filter(
				$products,
				static fn(Product $product) => $product->getCategory()->getSlug() === $category->getSlug(),
			);
		}

		$paginator = $this['paging']->getPaginator();
		$paginator->setItemCount(count($products));
		$paginator->setItemsPerPage(self::PER_PAGE);

		$offset = $paginator->getOffset();
		$products = array_slice($products, $offset, self::PER_PAGE);

		$this->template->setFile(__DIR__ . '/ProductList.latte');
		$this->template->products = $products;
	}

	protected function createComponentCategoryFilter(): CategoryFilterControl
	{
		$component = $this->categoryFilterControlFactory->create();
		$component->onFilter[] = function (): void {
			// reset to page 1 after changing filter
			$this['paging']->reset();
			$this->redirect('this');
		};

		return $component;
	}

	protected function createComponentPaging(): PagingControl
	{
		return $this->pagingControlFactory->create();
	}
}
