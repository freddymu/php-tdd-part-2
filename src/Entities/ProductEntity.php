<?php


namespace Freddymu\Entities;


class ProductEntity extends BaseEntity
{
  /**
   * @var int
   */
  public $price;
  /**
   * @var int
   */
  public $quantity;
  /**
   * @var string
   */
  public $productName;
  /**
   * @var string
   */
  public $productId;

  /**
   * ProductEntity constructor.
   */
  public function __construct(
    $productId = null,
    $productName = null,
    $quantity = null,
    $price = null)
  {
    $this->productId = $productId;
    $this->productName = $productName;
    $this->quantity = $quantity;
    $this->price = $price;
  }
}
