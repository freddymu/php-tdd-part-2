<?php

namespace Units;

use Faker\Factory;
use Freddymu\Models\CartModel;
use Freddymu\UseCase\CartService;
use Freddymu\Entities\ProductEntity;
use PHPUnit\Framework\TestCase;

class CartUnitTest extends TestCase
{
  private $faker;

  protected function setUp(): void
  {
    $this->faker = Factory::create('id_ID');
  }

  function createProductEntity(
    $isProductIdNull = false,
    $isProductNameNull = false,
    $isQuantityNull = false,
    $isPriceNull = false)
  {

    // because it was called from dataProvider
    // dataProvider is in different context
    $this->faker = Factory::create('id_ID');

    $productEntity = new ProductEntity();
    $productEntity->productId = $isProductIdNull
      ? null
      : $this->faker->numberBetween(1, 100);
    $productEntity->productName = $isProductNameNull
      ? null
      : $this->faker->word;
    $productEntity->quantity = $isQuantityNull
      ? null
      : $this->faker->randomDigit() + 1;
    $productEntity->price = $isPriceNull
      ? null
      : $this->faker->numberBetween(100000, 500000);

    return $productEntity;
  }

  function someTestCases()
  {
    return [
      [$this->createProductEntity()],
      [$this->createProductEntity()],
      [$this->createProductEntity()],
      [$this->createProductEntity()],
    ];
  }

  function testInvalidProductId_WhenAddItemToCart_WithDummyObject()
  {
    // Given

    $productEntity = new ProductEntity();
    $productEntity->productId = null;
    $productEntity->productName = $this->faker->word();
    $productEntity->quantity = $this->faker->randomDigit() + 1;
    $productEntity->price = $this->faker->numberBetween(100000, 500000);

    // Dummy object, just to pass the constructor
    $cartModel = $this->createMock(CartModel::class);

    $cart = new CartService($cartModel);

    // When
    $result = $cart->addItem($productEntity);

    // var_dump($result);

    // Then
    self::assertFalse($result->success);
    self::assertNotNull($result->message, $result->message);

    // many assertion could indicate your SUT object are violating Single Responsibility principles
  }

  /**
   * @dataProvider someTestCases
   */
  function testAddItemToCart_WithDataProvider_WithStub($productEntity)
  {
    // Given
    $cartModelStub = $this->createStub(CartModel::class);

    // Mock setup expectation
    $cartModelStub->expects(self::once())
              ->method('add')
              ->willReturn(true);

    $cart = new CartService($cartModelStub);

    // When
    $result = $cart->addItem($productEntity);

    // var_dump($result);

    // Then
    self::assertTrue($result->success);
  }

//  function testListItemOnCart()
//  {
//    // Given
//    $cart = new Cart();
//
//    // When
//    $result = $cart->getItems();
//
//    // Then
//    self::assertNotEmpty($result);
//
//  }
//
//  function testUpdatesAnItemQuantity()
//  {
//    // Given
//    $cart = new Cart();
//    $productEntity = new ProductEntity();
//    $productEntity->productId = $this->faker->uuid;
//    $productEntity->productName = $this->faker->word;
//    $productEntity->quantity = $this->faker->randomDigit() + 1;
//    $productEntity->price = $this->faker->numberBetween(100000, 500000);
//
//    // When
//    $result = $cart->addItem($productEntity);
//
//    self::assertContains($productEntity, $result);
//
//    $productEntity->quantity = $this->faker->randomDigit() + 1;
//    $updatedCart = $cart->updateItem($productEntity);
//
//    // Then
//    self::assertContains($productEntity, $updatedCart);
//
//  }
//
//  function testCalculateItemsOnCart()
//  {
//    // Given
//    $cart = new Cart();
//
//    // When
//    $result = $cart->calculateItemsOnCart();
//
//    // print_r($result);
//
//    // Then
//    self::assertGreaterThan(0, $result);
//  }
//
//  function testRemovesAnItem()
//  {
//    // Given
//    $cart = new Cart();
//    $products = $cart->getItems();
//    $productEntity = array_pop($products);
//
//    // When
//    $result = $cart->removeItem($productEntity);
//
//    // Then
//    self::assertNotContains($productEntity, $result);
//  }

  protected function tearDown(): void
  {

  }


}
