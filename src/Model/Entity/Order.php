<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $order_id
 * @property string $total_paid_amount
 * @property string $order_status
 * @property string $order_type
 * @property string $payment_type
 * @property string $payment_status
 * @property \Cake\I18n\FrozenTime $order_date
 * @property \Cake\I18n\FrozenTime $payment_date
 * @property int $store_id
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Order[] $orders
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\OrderItemToping[] $order_item_topings
 */
class Order extends Entity
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
        'total_paid_amount' => true,
        'order_status' => true,
        'order_type' => true,
        'payment_type' => true,
        'payment_status' => true,
        'order_date' => true,
        'payment_date' => true,
        'store_id' => true,
        'customer' => true,
        'orders' => true,
        'store' => true,
        'order_items' => true
    ];
}
