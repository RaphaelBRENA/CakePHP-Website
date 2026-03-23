<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comment Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $recipe_id
 * @property string|null $title
 * @property string|null $comment
 * @property \Cake\I18n\DateTime|null $date
 * @property int|null $rate
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Recipe $recipe
 */
class Comment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'recipe_id' => true,
        'title' => true,
        'comment' => true,
        'date' => true,
        'rate' => true,
        'user' => true,
        'recipe' => true,
    ];
}
