<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property int $category_id
 * @property int $brand_id
 * @property string $name
 * @property string $image
 * @property string $price
 * @property string $short_description
 * @property string $status
 * @property \Cake\I18n\FrozenTime $added_date
 * @property \Cake\I18n\FrozenTime $modified_date
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\ItemSize[] $item_sizes
 */
class Item extends Entity
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
        'category_id' => true,
        'brand_id' => true,
        'name' => true,
        'image' => true,
        'price' => true,
        'short_description' => true,
        'status' => true,
        'added_date' => true,
        'modified_date' => true,
        'category' => true,
        'brand' => true,
        'item_sizes' => true
    ];
}
