<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\CategoryFilter;

interface CategoryFilterControlFactory
{
	public function create(): CategoryFilterControl;
}
