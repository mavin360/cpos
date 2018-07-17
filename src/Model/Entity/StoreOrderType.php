<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StoreOrderType Entity
 *
 * @property int $id
 * @property int $store_id
 * @property string $name
 * @property string $surcharge
 * @property string $order_type
 * @property string $status
 * @property \Cake\I18n\FrozenTime $added_date
 * @property \Cake\I18n\FrozenTime $modify_date
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\OrderTypeStore[] $order_type_stores
 */
class StoreOrderType extends Entity
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
        'store_id' => true,
		'added_by' => true,
        'name' => true,
        'surcharge' => true,
        'order_type' => true,
        'status' => true,
        'added_date' => true,
        'modify_date' => true,
        'store' => true,
        'order_type_stores' => true
    ];
}
