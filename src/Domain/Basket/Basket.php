<?php

declare(strict_types=1);

namespace Naja\Guide\Domain\Basket;

use Brick\Math\BigInteger;
use Brick\Money\Money;
use Naja\Guide\Domain\Catalog\Product;
use Nette\Http\Session;
use Nette\Http\SessionSection;

final class Basket
{
	private SessionSection $session;

	public function __construct(
		Session $session,
	)
	{
		$this->session = $session->getSection(self::class);
	}

	/**
	 * @return BasketItem[]
	 */
	public function getItems(): array
	{
		return $this->session->get('items') ?? [];
	}

	public function getItem(Product $product): ?BasketItem
	{
		foreach ($this->getItems() as $item) {
			if ($item->product->getId() === $product->getId()) {
				return $item;
			}
		}

		return null;
	}

	public function add(Product $product, int $amount = 1): void
	{
		foreach ($this->getItems() as $item) {
			if ($item->product->getId() === $product->getId()) {
				$item->amount = $item->amount->plus($amount);
				return;
			}
		}

		$this->session->set('items', [
			...$this->getItems(),
			new BasketItem($product, BigInteger::of($amount)),
		]);
	}

	public function subtract(Product $product, int $amount = 1): void
	{
		foreach ($this->getItems() as $item) {
			if ($item->product->getId() === $product->getId()) {
				$item->amount = $item->amount->minus($amount);
				if ($item->amount->isLessThanOrEqualTo(0)) {
					$this->remove($product);
				}
				return;
			}
		}
	}

	public function remove(Product $product): void
	{
		$newItems = [];
		foreach ($this->getItems() as $item) {
			if ($item->product->getId() !== $product->getId()) {
				$newItems[] = $item;
			}
		}

		$this->session->set('items', $newItems);
	}

	public function countItems(): int
	{
		$itemsCount = BigInteger::zero();
		foreach ($this->getItems() as $item) {
			$itemsCount = $itemsCount->plus($item->amount);
		}

		return $itemsCount->toInt();
	}

	public function getTotalPrice(): Money
	{
		$totalPrice = Money::zero('USD');
		foreach ($this->getItems() as $item) {
			$totalPrice = $totalPrice->plus($item->product->getPrice()->multipliedBy($item->amount));
		}

		return $totalPrice;
	}
}
