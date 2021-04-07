<?php

namespace Freddymu\Entities;

use Freddymu\Entities\ProductEntity;

class CartEntity {

  /**
   * @var string
   */
  public $id;

  /**
   * @var ProductEntity[]
   */
  public $items;

  /**
   * @var VoucherEntity
   */
  public $voucher;

  /**
   * @var DateTime
   */
  public $createdAt;

}
