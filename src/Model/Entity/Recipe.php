<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Recipe Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $preparation
 * @property int|null $resting
 * @property int|null $cooking
 * @property int|null $servings
 * @property int|null $difficulty_level
 * @property float|null $price
 * @property int|null $ratings
 *
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Step[] $steps
 * @property \App\Model\Entity\Ingredient[] $ingredients
 * @property \App\Model\Entity\Tag[] $tags
 * @property \App\Model\Entity\Ustensil[] $ustensils
 */
class Recipe extends Entity
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
        'name' => true,
        'description' => true,
        'preparation' => true,
        'resting' => true,
        'cooking' => true,
        'servings' => true,
        'difficulty_level' => true,
        'price' => true,
        'ratings' => true,
        'comments' => true,
        'steps' => true,
        'ingredients' => true,
        'tags' => true,
        'ustensils' => true,
    ];
}
