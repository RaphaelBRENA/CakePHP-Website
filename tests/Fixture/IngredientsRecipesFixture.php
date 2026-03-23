<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IngredientsRecipesFixture
 */
class IngredientsRecipesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'recipe_id' => 1,
                'ingredient_id' => 1,
                'quantity' => 1,
            ],
        ];
        parent::init();
    }
}
