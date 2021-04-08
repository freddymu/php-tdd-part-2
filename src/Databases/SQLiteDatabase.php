<?php

namespace Freddymu\Databases;

class SQLiteDatabase
{
  private $db;

  protected $tableName;

  final public function __construct($dbPath = null)
  {
    $filename = $dbPath ?? __DIR__ . DIRECTORY_SEPARATOR . 'test.db';
    $this->db = new \SQLite3($filename);
  }

  public function setTableName($tableName) {
    $this->tableName = $tableName;
  }

  public function browse(array $payload = [])
  {
    return $this->db->query("SELECT * FROM {$this->tableName}");
  }

  public function read(array $payload)
  {

  }

  public function edit(array $payload)
  {

  }

  public function add(array $payload)
  {
    $fields = implode(',', array_keys($payload));
    $values = ':' . implode(', :', array_keys($payload));

    $stmt = $this->db->prepare("INSERT INTO {$this->tableName}({$fields}) VALUES({$values})");

    foreach ($payload as $key => $value) {
      if (is_string($value)) {
        $stmt->bindValue(":{$key}", $value, SQLITE3_TEXT);
      } else if (is_numeric($value)) {
        $stmt->bindValue(":{$key}", $value, SQLITE3_INTEGER);
      }
    }

    return $stmt->execute() !== false;
  }

  public function delete(array $payload)
  {

  }


}
