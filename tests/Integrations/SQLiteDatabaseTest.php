<?php


namespace Integrations;


use Faker\Factory;
use Freddymu\Databases\SQLiteDatabase;
use PHPUnit\Framework\TestCase;

class SQLiteDatabaseTest extends TestCase
{
  private $faker;

  protected function setUp(): void
  {
    $this->faker = Factory::create('id_ID');
  }

  function testOpenConnection()
  {
    //TODO: OpenConnection

    // Given
    $db = new SQLiteDatabase();

    // When

    // Then
    self::assertNotNull($db);
  }

  function testBrowse()
  {
    //TODO: Browse

    // Given
    $db = new SQLiteDatabase();
    $tableName = 'carts';

    // When
    $result = $db->browse($tableName);

    // var_dump($result);

    // Then
    self::assertNotEmpty($result);
  }

  function testAddData()
  {
    // Given
    $db = new SQLiteDatabase();
    $tableName = 'carts';
    $payload = [
      'productId' => $this->faker->numberBetween(1, 100),
      'productName' => $this->faker->name,
      'quantity' => $this->faker->randomDigit() + 1,
      'price' => $this->faker->randomElement([10000, 20000, 30000, 40000, 50000])
    ];

    // When
    $result = $db->add($tableName, $payload);

    // var_dump($result);

    // Then
    self::assertNotNull($result);
  }

}
