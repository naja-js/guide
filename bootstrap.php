<?php

declare(strict_types=1);

namespace Naja\Guide;

use Nette\Configurator;
use Nette\DI\Container;
use Nette\StaticClass;

require __DIR__ . '/vendor/autoload.php';

final class Bootstrap
{
	use StaticClass;

	public static function boot(?string $configFile = null): Container
	{
		$configurator = new Configurator();

		$configurator->addParameters([
			'rootDir' => __DIR__,
			'logDir' => $logDir = __DIR__ . '/var/log',
			'tempDir' => $tempDir = __DIR__ . '/var/tmp',
		]);

		$configurator->setTempDirectory($tempDir);
		$configurator->enableTracy($logDir);

		$configurator->addConfig(__DIR__ . '/etc/config.neon');
		$configurator->addConfig($configFile ?? []);

		return $configurator->createContainer();
	}
}
