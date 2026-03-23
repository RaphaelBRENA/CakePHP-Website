<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RecipesUstensilsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RecipesUstensilsTable Test Case
 */
class RecipesUstensilsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RecipesUstensilsTable
     */
    protected $RecipesUstensils;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.RecipesUstensils',
        'app.Recipes',
        'app.Ustensils',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RecipesUstensils') ? [] : ['className' => RecipesUstensilsTable::class];
        $this->RecipesUstensils = $this->getTableLocator()->get('RecipesUstensils', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->RecipesUstensils);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\RecipesUstensilsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
