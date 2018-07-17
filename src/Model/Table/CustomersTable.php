<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Customers Model
 *
 * @method \App\Model\Entity\Customer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Customer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Customer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Customer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Customer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Customer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Customer findOrCreate($search, callable $callback = null, $options = [])
 */
class CustomersTable extends Table
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

        $this->setTable('customers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id'
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
            ->integer('added_by')
            ->requirePresence('added_by', 'create')
            ->notEmpty('added_by');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmpty('name');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 50)
            ->allowEmpty('phone');

        $validator
            ->scalar('pincode')
            ->maxLength('pincode', 7)
            ->allowEmpty('pincode');

        $validator
            ->scalar('locality')
            ->maxLength('locality', 255)
            ->allowEmpty('locality');

        $validator
            ->scalar('address')
            ->maxLength('address', 255)
            ->allowEmpty('address');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmpty('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 255)
            ->allowEmpty('state');

        $validator
            ->scalar('landmark')
            ->maxLength('landmark', 255)
            ->allowEmpty('landmark');

        $validator
            ->scalar('alternate_phone')
            ->maxLength('alternate_phone', 13)
            ->allowEmpty('alternate_phone');

        $validator
            ->scalar('address_type')
            ->maxLength('address_type', 50)
            ->allowEmpty('address_type');

        $validator
            ->scalar('status')
            ->maxLength('status', 10)
            ->allowEmpty('status');

        $validator
            ->scalar('default_address')
            ->maxLength('default_address', 5)
            ->allowEmpty('default_address');

        $validator
            ->dateTime('added_date')
            ->requirePresence('added_date', 'create')
            ->notEmpty('added_date');

        return $validator;
    }
}
