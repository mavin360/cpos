<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemSize Entity
 *
 * @property int $id
 * @property int $item_id
 * @property string $size_name
 * @property string $size_price
 * @property \Cake\I18n\FrozenTime $added_date
 *
 * @property \App\Model\Entity\Item $item
 */
class ItemSize extends Entity
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
        'item_id' => true,
        'size_name' => true,
        'size_price' => true,
        'added_date' => true,
        'item' => true
    ];
}
