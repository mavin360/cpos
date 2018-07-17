<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderItemToppings Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\OrderItemTopping get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderItemTopping newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderItemTopping[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderItemTopping|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderItemTopping|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderItemTopping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItemTopping[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItemTopping findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderItemToppingsTable extends Table
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

        $this->setTable('order_item_toppings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id'
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id'
        ]);
		$this->belongsTo('OrderItems', [
            'foreignKey' => 'order_item_id'
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
            ->scalar('topping_name')
            ->maxLength('topping_name', 255)
            ->allowEmpty('topping_name');

        $validator
            ->scalar('topping_amount')
            ->maxLength('topping_amount', 50)
            ->allowEmpty('topping_amount');

        $validator
            ->dateTime('added_date')
            ->requirePresence('added_date', 'create')
            ->notEmpty('added_date');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));

        return $rules;
    }
}
