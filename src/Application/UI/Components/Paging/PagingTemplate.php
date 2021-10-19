<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Components\Paging;

use Naja\Guide\Application\UI\BaseTemplate;
use Nette\Utils\Paginator;

final class PagingTemplate extends BaseTemplate
{
	public Paginator $paginator;
}
