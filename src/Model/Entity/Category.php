<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Category Entity
 *
 * @property int $id
 * @property int $store_id
 * @property int $brand_id
 * @property string $name
 * @property string $slug
 * @property string $short_description
 * @property string $image
 * @property int $sort_order
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Store $store
 * @property \App\Model\Entity\Brand $brand
 */
class Category extends Entity
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
        'brand_id' => true,
        'name' => true,
        'slug' => true,
        'short_description' => true,
        'image' => true,
        'sort_order' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'store' => true,
        'brand' => true
    ];
}
