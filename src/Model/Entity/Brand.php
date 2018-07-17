<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Brand Entity
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property string $description
 * @property int $store_id
 * @property int $added_by
 * @property \Cake\I18n\FrozenTime $added_date
 *
 * @property \App\Model\Entity\Store $store
 */
class Brand extends Entity
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
        'name' => true,
        'logo' => true,
        'description' => true,
        'store_id' => true,
		'sort_order' => true,
        'added_by' => true,
        'added_date' => true,
		'brand_stores' => true,
    ];
}
