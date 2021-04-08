<?php

namespace Freddymu\Entities;

use Freddymu\Entities\ProductEntity;

class CartEntity extends BaseEntity {

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
