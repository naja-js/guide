<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\BasketWidget;

interface BasketWidgetControlFactory
{
	public function create(): BasketWidgetControl;
}
