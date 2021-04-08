<?php

namespace Freddymu\Databases;

class SQLiteDatabase
{
  private $db;

  final public function __construct($dbPath = null)
  {
    $filename = $dbPath ?? __DIR__ . DIRECTORY_SEPARATOR . 'test.db';
    $this->db = new \SQLite3($filename);
  }

  public function browse($tableName, array $payload = [])
  {
    return $this->db->query("SELECT * FROM {$tableName}")->fetchArray();
  }

  public function read($tableName, array $payload)
  {

  }

  public function edit($tableName, array $payload)
  {

  }

  public function add($tableName, array $payload)
  {
    $fields = implode(',', array_keys($payload));
    $values = ':' . implode(', :', array_keys($payload));

    $stmt = $this->db->prepare("INSERT INTO {$tableName}({$fields}) VALUES({$values})");

    foreach ($payload as $key => $value) {
      if (is_string($value)) {
        $stmt->bindValue(":{$key}", $value, SQLITE3_TEXT);
      } else if (is_numeric($value)) {
        $stmt->bindValue(":{$key}", $value, SQLITE3_INTEGER);
      }
    }

    return $stmt->execute();
  }

  public function delete($tableName, array $payload)
  {

  }


}
