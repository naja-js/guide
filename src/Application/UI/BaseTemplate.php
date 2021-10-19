<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI;

use Brick\Money\Money;
use Latte\Attributes\TemplateFilter;
use Nette\Bridges\ApplicationLatte\Template;

abstract class BaseTemplate extends Template
{
	public string $basePath;

	#[TemplateFilter]
	public function money(Money $money): string
	{
		return $money->formatTo('en_US');
	}
}
