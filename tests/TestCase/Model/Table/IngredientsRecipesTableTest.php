<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IngredientsRecipesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IngredientsRecipesTable Test Case
 */
class IngredientsRecipesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IngredientsRecipesTable
     */
    protected $IngredientsRecipes;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.IngredientsRecipes',
        'app.Recipes',
        'app.Ingredients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('IngredientsRecipes') ? [] : ['className' => IngredientsRecipesTable::class];
        $this->IngredientsRecipes = $this->getTableLocator()->get('IngredientsRecipes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->IngredientsRecipes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IngredientsRecipesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\IngredientsRecipesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
