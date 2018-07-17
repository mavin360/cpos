<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StoreOrderTypes Model
 *
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 * @property \App\Model\Table\OrderTypeStoresTable|\Cake\ORM\Association\HasMany $OrderTypeStores
 *
 * @method \App\Model\Entity\StoreOrderType get($primaryKey, $options = [])
 * @method \App\Model\Entity\StoreOrderType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StoreOrderType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StoreOrderType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreOrderType|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreOrderType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StoreOrderType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StoreOrderType findOrCreate($search, callable $callback = null, $options = [])
 */
class StoreOrderTypesTable extends Table
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

        $this->setTable('store_order_types');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('OrderTypeStores', [
            'foreignKey' => 'store_order_type_id'
        ]);
		$this->belongsToMany('Stores', [
            'joinTable' => 'order_type_stores',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmpty('name');

        $validator
            ->scalar('surcharge')
            ->maxLength('surcharge', 255)
            ->allowEmpty('surcharge');

        $validator
            ->scalar('order_type')
            ->maxLength('order_type', 255)
            ->allowEmpty('order_type');

        $validator
            ->scalar('status')
            ->allowEmpty('status');

        $validator
            ->dateTime('added_date')
            ->allowEmpty('added_date');

        $validator
            ->dateTime('modify_date')
            ->allowEmpty('modify_date');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['store_id'], 'Stores'));

        return $rules;
    }
}
