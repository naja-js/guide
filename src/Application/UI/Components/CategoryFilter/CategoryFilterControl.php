<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\CategoryFilter;

use Naja\Guide\Domain\Catalog\Category;
use Naja\Guide\Domain\Catalog\CategoryRepository;
use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

final class CategoryFilterControl extends Control
{
	#[Persistent]
	public ?string $category = null;

	/** @var callable[] */
	public array $onFilter = [];

	private ?Category $selectedCategory = null;

	private array $allCategories;

	public function __construct(
		private CategoryRepository $categoryRepository,
	)
	{
		$this->allCategories = $this->categoryRepository->findAll();
		$this->onAnchor[] = function (): void {
			$presenter = $this->getPresenter();
			\assert($presenter !== null);

			if ($this->category !== null) {
				$this->selectedCategory = $this->categoryRepository->getBySlug($this->category);
			}

			$this['form-category']->setDefaultValue($this->category);
		};
	}

	public function getSelectedCategory(): ?Category
	{
		return $this->selectedCategory;
	}

	public function render(): void
	{
		$this->template->render(__DIR__ . '/CategoryFilterControl.latte');
	}

	protected function createComponentForm(): Form
	{
		$form = new Form();

		$items = [];
		foreach ($this->allCategories as $category) {
			$items[$category->getSlug()] = $category->getName();
		}

		$form->addSelect('category', 'Filter by category:', $items)
			->setPrompt('All products');

		$form->addSubmit('filter', 'Filter');
		$form->onSuccess[] = function ($form, $values): void {
			$category = $values->category;
			$this->selectedCategory = $category !== null
				? $this->categoryRepository->getBySlug($category)
				: null;

			$this->category = $category;
			$this->onFilter($this->selectedCategory);
		};

		return $form;
	}
}
