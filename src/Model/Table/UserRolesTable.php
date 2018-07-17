<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * UserRoles Model
 *
 * @property \App\Model\Table\AclsTable|\Cake\ORM\Association\HasMany $Acls
 *
 * @method \App\Model\Entity\UserRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\UserRole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UserRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UserRole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserRole|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UserRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UserRole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UserRole findOrCreate($search, callable $callback = null, $options = [])
 */
class UserRolesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('user_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Acls', [
            'foreignKey' => 'user_role_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('role_name')
            ->maxLength('role_name', 255)
            ->requirePresence('role_name', 'create')
            ->notEmpty('role_name');

        $validator
            ->scalar('role_status')
            ->requirePresence('role_status', 'create')
            ->notEmpty('role_status');

        $validator
            ->scalar('role_description')
            ->maxLength('role_description', 500)
            ->allowEmpty('role_description');

        $validator
            ->dateTime('added_date')
            ->requirePresence('added_date', 'create')
            ->notEmpty('added_date');

        $validator
            ->dateTime('modify_date')
            ->requirePresence('modify_date', 'create')
            ->notEmpty('modify_date');

        $validator
            ->integer('added_by')
            ->requirePresence('added_by', 'create')
            ->notEmpty('added_by');

        return $validator;
    }
}
