<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Microposts Model
 *
 * @method \App\Model\Entity\Micropost get($primaryKey, $options = [])
 * @method \App\Model\Entity\Micropost newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Micropost[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Micropost|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Micropost saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Micropost patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Micropost[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Micropost findOrCreate($search, callable $callback = null, $options = [])
 */
class MicropostsTable extends Table
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

        $this->setTable('microposts');
        $this->belongsTo('User', [
            'joinType' => 'LEFT OUTER',  //join方法
            'foreignKey' => 'user_id', //自分側のテーブルの参照カラム（相手側のmodel名_idなら省略できる。）
            'bindingKey' => 'id',         ]);
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
            ->scalar('user_id')
            ->requirePresence('user_id', 'create');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->maxLength('content', 140);

        return $validator;
    }
}
