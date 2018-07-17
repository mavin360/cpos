<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItem Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $user_order_id
 * @property int $item_id
 * @property string $size
 * @property string $size_amount
 * @property int $brand_id
 * @property int $quantity
 * @property string $unit_price
 * @property string $total_price
 * @property \Cake\I18n\FrozenTime $added_date
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\UserOrder $user_order
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\Brand $brand
 */
class OrderItem extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'customer_id' => true,
        'order_id' => true,
        'item_id' => true,
        'size' => true,
        'size_amount' => true,
        'brand_id' => true,
        'quantity' => true,
        'unit_price' => true,
        'total_price' => true,
        'added_date' => true,
		'status' => true,
        'customer' => true,
        'user_order' => true,
        'item' => true,
        'brand' => true,
		'order_item_toppings'=>true,
    ];
}
