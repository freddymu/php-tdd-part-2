<?php


namespace Freddymu\UseCase;


use Freddymu\Entities\ProductEntity;

class Cart
{

  /**
   * @var ProductEntity[]
   */
  private static $items = [];

  /**
   * Cart constructor.
   */
  public function __construct()
  {

  }

  public function addItem(ProductEntity $productEntity)
  {
    self::$items[] = $productEntity;
    return self::$items;
  }

  public function getItems()
  {
    return self::$items;
  }

  public function updateItem(ProductEntity $productEntity)
  {
    $foundIndex = null;
    $foundItem = null;

    foreach (self::$items as $index => $item) {
      if ($item->id === $productEntity->id) {
        $foundIndex = $index;
        $foundItem = $item;
        break;
      }
    }

    if ($foundIndex === null || $foundItem === null) {
      return null;
    }

    self::$items[$foundIndex] = $productEntity;

    return self::$items;
  }

  public function removeItem(ProductEntity $productEntity)
  {
    $foundIndex = null;

    foreach (self::$items as $index => $item) {
      if ($item->id === $productEntity->id) {
        $foundIndex = $index;
        break;
      }
    }

    if ($foundIndex === null) {
      return null;
    }

    unset(self::$items[$foundIndex]);

    return self::$items;
  }
}
