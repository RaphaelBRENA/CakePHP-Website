<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RecipesUstensilsFixture
 */
class RecipesUstensilsFixture extends TestFixture
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
                'ustensil_id' => 1,
            ],
        ];
        parent::init();
    }
}
