<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * StoreTimes Model
 *
 * @property \App\Model\Table\StoreLocationsTable|\Cake\ORM\Association\BelongsTo $StoreLocations
 *
 * @method \App\Model\Entity\StoreTime get($primaryKey, $options = [])
 * @method \App\Model\Entity\StoreTime newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\StoreTime[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\StoreTime|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreTime|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\StoreTime patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\StoreTime[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\StoreTime findOrCreate($search, callable $callback = null, $options = [])
 */
class StoreTimesTable extends Table
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

        $this->setTable('store_times');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('from_open_day')
            ->maxLength('from_open_day', 255)
            ->allowEmpty('from_open_day');

        $validator
            ->scalar('to_open_day')
            ->maxLength('to_open_day', 255)
            ->allowEmpty('to_open_day');

        $validator
            ->scalar('from_open_time')
            ->maxLength('from_open_time', 255)
            ->allowEmpty('from_open_time');

        $validator
            ->scalar('to_open_time')
            ->maxLength('to_open_time', 255)
            ->allowEmpty('to_open_time');

        $validator
            ->scalar('status')
            ->maxLength('status', 255)
            ->allowEmpty('status');

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
        return $rules;
    }
}
