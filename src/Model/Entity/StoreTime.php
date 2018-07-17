<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StoreTime Entity
 *
 * @property int $id
 * @property int $store_location_id
 * @property string $from_open_day
 * @property string $to_open_day
 * @property string $from_open_time
 * @property string $to_open_time
 * @property string $status
 * @property \Cake\I18n\FrozenTime $added_date
 *
 * @property \App\Model\Entity\StoreLocation $store_location
 */
class StoreTime extends Entity
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
        'from_open_day' => true,
        'to_open_day' => true,
        'from_open_time' => true,
        'to_open_time' => true,
        'status' => true,
        'added_date' => true,
        'store_location' => true
    ];
}
