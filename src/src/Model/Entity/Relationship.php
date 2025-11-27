<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Relationship Entity
 *
 * @property int $id
 * @property int $follower_id
 * @property int $followed_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 */
class Relationship extends Entity
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
        'follower_id' => true,
        'followed_id' => true,
        'created' => true,
        'modified' => true,
        // TODO: これいる？
        // 'follower' => true,
        // 'followed' => true,
    ];
}
