<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderTypeStore Entity
 *
 * @property int $id
 * @property int $store_order_type_id
 * @property int $store_id
 * @property \Cake\I18n\FrozenTime $added_date
 *
 * @property \App\Model\Entity\StoreOrderType $store_order_type
 * @property \App\Model\Entity\Store $store
 */
class OrderTypeStore extends Entity
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
        'store_order_type_id' => true,
        'store_id' => true,
        'added_date' => true,
        'store_order_type' => true,
        'store' => true
    ];
}
