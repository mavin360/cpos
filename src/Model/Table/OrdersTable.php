<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\BelongsTo $Customers
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\StoresTable|\Cake\ORM\Association\BelongsTo $Stores
 * @property \App\Model\Table\OrderItemTopingsTable|\Cake\ORM\Association\HasMany $OrderItemTopings
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\HasMany $Orders
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Stores', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('OrderItems', [
            'foreignKey' => 'order_id'
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'order_id'
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
            ->scalar('total_paid_amount')
            ->maxLength('total_paid_amount', 50)
            ->allowEmpty('total_paid_amount');

        $validator
            ->scalar('order_status')
            ->allowEmpty('order_status');

        $validator
            ->scalar('order_type')
            ->maxLength('order_type', 255)
            ->allowEmpty('order_type');

        $validator
            ->scalar('payment_type')
            ->maxLength('payment_type', 50)
            ->allowEmpty('payment_type');

        $validator
            ->scalar('payment_status')
            ->maxLength('payment_status', 50)
            ->allowEmpty('payment_status');

        $validator
            ->dateTime('order_date')
            ->allowEmpty('order_date');

        $validator
            ->dateTime('payment_date')
            ->allowEmpty('payment_date');

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
        $rules->add($rules->existsIn(['store_id'], 'Stores'));
        return $rules;
    }
}
