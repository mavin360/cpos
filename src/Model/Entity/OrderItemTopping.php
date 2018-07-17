<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderItemTopping Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $item_id
 * @property string $topping_name
 * @property string $topping_amount
 * @property \Cake\I18n\FrozenTime $added_date
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Item $item
 */
class OrderItemTopping extends Entity
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
        'order_id' => true,
        'item_id' => true,
		'order_item_id' => true,
        'topping_name' => true,
        'topping_amount' => true,
        'added_date' => true,
        'order' => true,
        'item' => true
    ];
}
