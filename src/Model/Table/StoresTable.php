<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Stores Model
 *
 * @property \App\Model\Table\CompaniesTable|\Cake\ORM\Association\BelongsTo $Companies
 * @property \App\Model\Table\BrandsTable|\Cake\ORM\Association\HasMany $Brands
 * @property \App\Model\Table\CategoriesTable|\Cake\ORM\Association\HasMany $Categories
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\HasMany $Customers
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\HasMany $Orders
 * @property |\Cake\ORM\Association\HasMany $StoreTimes
 *
 * @method \App\Model\Entity\Store get($primaryKey, $options = [])
 * @method \App\Model\Entity\Store newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Store[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Store|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Store|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Store patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Store[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Store findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StoresTable extends Table
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

        $this->setTable('stores');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Brands', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('Categories', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('Orders', [
            'foreignKey' => 'store_id'
        ]);
        $this->hasMany('StoreTimes', [
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
            ->scalar('store_name')
            ->maxLength('store_name', 255)
            ->requirePresence('store_name', 'create')
            ->notEmpty('store_name');

        $validator
            ->scalar('store_address')
            ->maxLength('store_address', 255)
            ->requirePresence('store_address', 'create')
            ->notEmpty('store_address');

        $validator
            ->scalar('store_image')
            ->maxLength('store_image', 255)
            ->allowEmpty('store_image');

        $validator
            ->scalar('store_phone')
            ->maxLength('store_phone', 255)
            ->allowEmpty('store_phone');

        $validator
            ->scalar('store_email')
            ->maxLength('store_email', 255)
            ->allowEmpty('store_email');

        $validator
            ->scalar('city')
            ->maxLength('city', 255)
            ->allowEmpty('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 255)
            ->allowEmpty('state');

        $validator
            ->scalar('country')
            ->maxLength('country', 255)
            ->allowEmpty('country');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 255)
            ->allowEmpty('zip');

        $validator
            ->scalar('latitude')
            ->maxLength('latitude', 255)
            ->allowEmpty('latitude');

        $validator
            ->scalar('longitude')
            ->maxLength('longitude', 255)
            ->allowEmpty('longitude');

        $validator
            ->scalar('delivery_radius')
            ->maxLength('delivery_radius', 255)
            ->allowEmpty('delivery_radius');

        $validator
            ->scalar('notification_email')
            ->maxLength('notification_email', 255)
            ->allowEmpty('notification_email');

        $validator
            ->scalar('store_status')
            ->maxLength('store_status', 20)
            ->allowEmpty('store_status');

        $validator
            ->scalar('delivery_status')
            ->requirePresence('delivery_status', 'create')
            ->allowEmpty('delivery_status');

        $validator
            ->scalar('delivery_message')
            ->maxLength('delivery_message', 255)
            ->requirePresence('delivery_message', 'create')
            ->allowEmpty('delivery_message');

        $validator
            ->scalar('delivery_time')
            ->maxLength('delivery_time', 50)
            ->requirePresence('delivery_time', 'create')
            ->allowEmpty('delivery_time');

        $validator
            ->scalar('pickup_status')
            ->requirePresence('pickup_status', 'create')
            ->allowEmpty('pickup_status');

        $validator
            ->scalar('pickup_message')
            ->maxLength('pickup_message', 255)
            ->requirePresence('pickup_message', 'create')
            ->allowEmpty('pickup_message');

        $validator
            ->scalar('pickup_time')
            ->maxLength('pickup_time', 50)
            ->requirePresence('pickup_time', 'create')
            ->allowEmpty('pickup_time');

        $validator
            ->scalar('status')
            ->requirePresence('status', 'create')
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['company_id'], 'Users'));

        return $rules;
    }
}
