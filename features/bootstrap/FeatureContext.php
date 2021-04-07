<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
  private $shelf;
  private $basket;

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct()
  {
    $this->shelf = new Shelf();
    $this->basket = new Basket($this->shelf);
  }

  /**
   * @Given there is a(n) :arg1, which costs £:arg2
   */
  public function thereIsAWhichCostsPs($product, $price)
  {
    $this->shelf->setProductPrice($product, (float)$price);
  }

  /**
   * @When I add the :arg1 to the basket
   */
  public function iAddTheToTheBasket($product)
  {
    $this->basket->addProduct($product);
  }

  /**
   * @Then I should have :arg1 product in the basket
   */
  public function iShouldHaveProductInTheBasket($count)
  {
    \PHPUnit\Framework\assertCount(
      (int)$count,
      $this->basket->getProducts()
    );
  }

  /**
   * @Then the overall basket price should be £:arg1
   */
  public function theOverallBasketPriceShouldBePs($price)
  {
    \PHPUnit\Framework\assertSame(
      (float)$price,
      $this->basket->getTotalPrice()
    );
  }

  /**
   * @Then I should have :arg1 products in the basket
   */
  public function iShouldHaveProductsInTheBasket($count)
  {
    \PHPUnit\Framework\assertCount(
      (int)$count,
      $this->basket->getProducts()
    );
  }
}
