<?php

namespace Tests\Feature;

use Faker\Factory;
use Freddymu\UseCase\Cart;
use Freddymu\Entities\ProductEntity;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
  private $faker;

  protected function setUp(): void
  {
    $this->faker = Factory::create('id_ID');
  }

  function testAddItemToCart()
  {
    // Given
    $cart = new Cart();
    $productEntity = new ProductEntity();
    $productEntity->id = $this->faker->uuid;
    $productEntity->name = $this->faker->word();
    $productEntity->quantity = $this->faker->randomDigit() + 1;
    $productEntity->price = $this->faker->numberBetween(100000, 500000);

    // When
    $result = $cart->addItem($productEntity);

    // Then
    self::assertNotEmpty($result);
    self::assertContains($productEntity, $result);
  }

  function testListItemOnCart()
  {
    // Given
    $cart = new Cart();

    // When
    $result = $cart->getItems();

    // Then
    self::assertNotEmpty($result);

  }

  function testUpdatesAnItemQuantity()
  {
    // Given
    $cart = new Cart();
    $productEntity = new ProductEntity();
    $productEntity->id = $this->faker->uuid;
    $productEntity->name = $this->faker->word;
    $productEntity->quantity = $this->faker->randomDigit() + 1;
    $productEntity->price = $this->faker->numberBetween(100000, 500000);

    // When
    $result = $cart->addItem($productEntity);

    self::assertContains($productEntity, $result);

    $productEntity->quantity = $this->faker->randomDigit() + 1;
    $updatedCart = $cart->updateItem($productEntity);

    // Then
    self::assertContains($productEntity, $updatedCart);

  }

  function testCalculateItemsOnCart()
  {
    // Given
    $cart = new Cart();

    // When
    $result = $cart->calculateItemsOnCart();

    // print_r($result);

    // Then
    self::assertGreaterThan(0, $result);
  }

  function testRemovesAnItem()
  {
      // Given
    $cart = new Cart();
    $products = $cart->getItems();
    $productEntity = array_pop($products);

      // When
    $result = $cart->removeItem($productEntity);

      // Then
    self::assertNotContains($productEntity, $result);
  }

  protected function tearDown(): void
  {

  }


}
