<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $name
 * @property string $status
 * @property int $role_id
 * @property \Cake\I18n\FrozenTime $added_date
 * @property \Cake\I18n\FrozenTime $modified_date
 * @property \Cake\I18n\FrozenTime $last_login_date
 * @property string $last_login_ip
 * @property \Cake\I18n\FrozenTime $last_logout_date
 * @property bool $is_deleted
 * @property int $created_by
 * @property string $access_token
 * @property string $phone_otp
 * @property string $otp_verification
 *
 * @property \App\Model\Entity\Role $role
 */
class User extends Entity
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
        'email' => true,
        'phone' => true,
        'password' => true,
        'name' => true,
		'address' => true,
		'profile_image' => true,
        'status' => true,
        'role_id' => true,
		'brand_id' => true,
        'added_date' => true,
        'modified_date' => true,
        'last_login_date' => true,
        'last_login_ip' => true,
        'last_logout_date' => true,
        'is_deleted' => true,
        'created_by' => true,
        'access_token' => true,
        'phone_otp' => true,
        'otp_verification' => true,
        'role' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
