<?php


namespace Freddymu\Entities;


class BaseEntity
{
  public function toArray()
  {
    $arr = [];

    foreach ($this as $property => $value) {
      $arr[$property] = $value;
    }

    return $arr;
  }
}
