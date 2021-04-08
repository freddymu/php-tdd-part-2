<?php


namespace Units;


use Freddymu\Models\CartModel;
use PHPUnit\Framework\TestCase;

class CartModelTest extends TestCase
{
  private $model;

  protected function setUp(): void
  {
    $this->model = new CartModel();
  }


}
