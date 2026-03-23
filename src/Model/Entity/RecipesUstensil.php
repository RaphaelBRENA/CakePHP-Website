<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RecipesUstensil Entity
 *
 * @property int $recipe_id
 * @property int $ustensil_id
 *
 * @property \App\Model\Entity\Recipe $recipe
 * @property \App\Model\Entity\Ustensil $ustensil
 */
class RecipesUstensil extends Entity
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
        'recipe' => true,
        'ustensil' => true,
    ];
}
