<?php

declare(strict_types=1);

namespace Naja\Guide;

use Nette\Application\Application;

require __DIR__ . '/../bootstrap.php';

Bootstrap::boot()
	->getByType(Application::class)
	->run();
