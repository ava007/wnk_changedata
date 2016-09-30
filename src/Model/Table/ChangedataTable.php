<?php
namespace WnkChangedata\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use WnkTranslation\Model\Entity\Translation;
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
        $this->table('wnk_cdr');
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
