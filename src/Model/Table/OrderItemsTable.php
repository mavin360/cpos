<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderItems Model
 *
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\UserOrdersTable|\Cake\ORM\Association\BelongsTo $UserOrders
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 * @property \App\Model\Table\BrandsTable|\Cake\ORM\Association\BelongsTo $Brands
 *
 * @method \App\Model\Entity\OrderItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderItem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderItem findOrCreate($search, callable $callback = null, $options = [])
 */
class OrderItemsTable extends Table
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

        $this->setTable('order_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id'
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id'
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id'
        ]);
        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id'
        ]);
		$this->hasMany('OrderItemToppings', [
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
            ->scalar('size')
            ->maxLength('size', 50)
            ->allowEmpty('size');

        $validator
            ->scalar('size_amount')
            ->maxLength('size_amount', 50)
            ->allowEmpty('size_amount');

        $validator
            ->integer('quantity')
            ->allowEmpty('quantity');

        $validator
            ->scalar('unit_price')
            ->maxLength('unit_price', 10)
            ->allowEmpty('unit_price');

        $validator
            ->scalar('total_price')
            ->maxLength('total_price', 50)
            ->allowEmpty('total_price');

        $validator
            ->dateTime('added_date')
            ->allowEmpty('added_date');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));
        $rules->add($rules->existsIn(['brand_id'], 'Brands'));

        return $rules;
    }
}
