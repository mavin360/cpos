<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Store Entity
 *
 * @property int $id
 * @property int $company_id
 * @property string $store_name
 * @property string $store_address
 * @property string $store_image
 * @property string $store_phone
 * @property string $store_email
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $zip
 * @property string $latitude
 * @property string $longitude
 * @property string $delivery_radius
 * @property string $notification_email
 * @property string $store_status
 * @property string $delivery_status
 * @property string $delivery_message
 * @property string $delivery_time
 * @property string $pickup_status
 * @property string $pickup_message
 * @property string $pickup_time
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Brand[] $brands
 * @property \App\Model\Entity\Category[] $categories
 * @property \App\Model\Entity\Customer[] $customers
 * @property \App\Model\Entity\Order[] $orders
 */
class Store extends Entity
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
        'company_id' => true,
		'store' => true,
        'store_name' => true,
        'store_address' => true,
        'store_image' => true,
        'store_phone' => true,
        'store_email' => true,
        'city' => true,
        'state' => true,
        'country' => true,
        'zip' => true,
        'latitude' => true,
        'longitude' => true,
        'delivery_radius' => true,
        'notification_email' => true,
        'store_status' => true,
        'delivery_status' => true,
        'delivery_message' => true,
        'delivery_time' => true,
        'pickup_status' => true,
        'pickup_message' => true,
        'pickup_time' => true,
        'status' => true,
        'created' => true,
		'modified' => true,
		'print_label' => true,
		'tex_id' => true,
        'company' => true,
        'brands' => true,
        'categories' => true,
        'customers' => true,
        'orders' => true,
		'store_times' => true
    ];
}
