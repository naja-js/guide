<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\Paging;

interface PagingControlFactory
{
	public function create(): PagingControl;
}
