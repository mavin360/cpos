<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property int $added_by
 * @property string $name
 * @property string $phone
 * @property string $pincode
 * @property string $locality
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $landmark
 * @property string $alternate_phone
 * @property string $address_type
 * @property string $status
 * @property string $default_address
 * @property \Cake\I18n\FrozenTime $added_date
 */
class Customer extends Entity
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
        'added_by' => true,
        'name' => true,
		'sur_name' => true,
		'email' => true,
        'phone' => true,
        'city_zip' => true,
        'locality' => true,
        'address' => true,
        'apartment_no' => true,
        'street_no' => true,
        'street_name' => true,
        'city' => true,
        'state' => true,
		'country' => true,
        'landmark' => true,
        'alternate_phone' => true,
        'address_type' => true,
        'status' => true,
        'default_address' => true,
        'added_date' => true,
        'store_id' => true
    ];
}
