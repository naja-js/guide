<?php

declare(strict_types=1);

namespace Naja\Guide\Application\UI\Presenters;

use Naja\Guide\Application\UI\Components\BasketWidget\BasketWidgetControl;
use Naja\Guide\Application\UI\Components\BasketWidget\BasketWidgetControlFactory;
use Nette\Application\UI\Presenter;
use Nette\DI\Attributes\Inject;

abstract class BasePresenter extends Presenter
{
	#[Inject] public BasketWidgetControlFactory $basketWidgetComponentFactory;

	protected function createComponentBasketWidget(): BasketWidgetControl
	{
		return $this->basketWidgetComponentFactory->create();
	}

	protected function beforeRender(): void
	{
		parent::beforeRender();
		$this->redrawControl('title');
		$this->redrawControl('content');
		$this['basketWidget']->redrawControl();
	}
}
