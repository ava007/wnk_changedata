<?php
namespace WnkChangedata\Model\Entity;

use Cake\ORM\Entity;

/**
 * Change Entity
 *
 * @property string $id
 * @property \Cake\I18n\Time $created
 * @property string $email
 * @property string $sts
 * @property string $target_table
 * @property int $target_id
 * @property string $target_uuid
 * @property string $target_op
 * @property string $data_old
 * @property string $data_new
 * @property string $remarks
 * @property string $sourcecty
 * @property string $sourceip
 *
 * @property \WnkChangeData\Model\Entity\Target $target
 */
class Change extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'created' => true,
        'email' => true,
        'sts' => true,
        'target_table' => true,
        'target_id' => true,
        'target_uuid' => true,
        'target_op' => true,
        'data_old' => true,
        'data_new' => true,
        'remarks' => true,
        'sourcecty' => true,
        'sourceip' => true,
        'target' => true
    ];
}
