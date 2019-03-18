<?php
namespace WnkChangedata\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use WnkChangedata\Model\Entity\Changedata;
/**
 * Translations Model
 *
 */
class TranslationsTable extends Table
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
     
        $wnkConf = Configure::read('WnkChangedata');
        if (isset($wnkConf['tablePrefix']))
            $table = $wnkConf['tablePrefix'] . 'wnk_cdr';
        else
            $table = 'wnk_cdr';
        
        $this->table($table);
        $this->displayField('created');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
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
            ->allowEmpty('id', 'created');
        $validator
            ->requirePresence('targetTable', 'sts','target_op')
            ->notEmpty('msgid');
        $validator
            ->allowEmpty('cdr_remark');
        return $validator;
    }
}
