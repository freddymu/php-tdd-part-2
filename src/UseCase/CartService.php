<?php


namespace Freddymu\UseCase;


use Freddymu\Entities\GenericResponseEntity;
use Freddymu\Entities\ProductEntity;
use Freddymu\Models\CartModel;

class CartService
{

  private $model;

  /**
   * @var ProductEntity[]
   */
  private static $items = [];

  /**
   * Cart constructor.
   * @param CartModel $model
   */
  public function __construct(CartModel $model)
  {
    $this->model = $model;
  }

  public function addItem(ProductEntity $productEntity)
  {
    $response = new GenericResponseEntity();

    // validation
    if ($productEntity->productId === null) {
      $response->message = 'Product ID harus diisi.';
      return $response;
    }

    if ($productEntity->productName === null) {
      $response->message = 'Product Name harus diisi.';
      return $response;
    }

    if ($productEntity->quantity <= 0) {
      $response->message = 'Quantity produk harus diisi.';
      return $response;
    }

    if ($productEntity->price <= 0) {
      $response->message = 'Harga tidak boleh nol.';
      return $response;
    }

    $result = $this->model->add($productEntity->toArray());

    $response->success = $result;
    $response->message = 'adding new item to cart';
    $response->data = $result;

    return $response;
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
      if ($item->productId === $productEntity->productId) {
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
      if ($item->productId === $productEntity->productId) {
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

  public function calculateItemsOnCart()
  {
    $total = 0;

    foreach (self::$items as $item) {
      $total += $item->price * $item->quantity;
    }

    return $total;
  }
}
