<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserRole Entity
 *
 * @property int $id
 * @property string $role_name
 * @property string $role_status
 * @property string $role_description
 * @property \Cake\I18n\FrozenTime $added_date
 * @property \Cake\I18n\FrozenTime $modify_date
 * @property int $added_by
 *
 * @property \App\Model\Entity\Acl[] $acls
 */
class UserRole extends Entity
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
        'role_name' => true,
        'role_status' => true,
        'role_description' => true,
        'added_date' => true,
        'modify_date' => true,
        'added_by' => true,
        'acls' => true
    ];
}
