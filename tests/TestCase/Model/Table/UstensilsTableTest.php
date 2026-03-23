<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UstensilsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UstensilsTable Test Case
 */
class UstensilsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UstensilsTable
     */
    protected $Ustensils;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Ustensils',
        'app.Recipes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ustensils') ? [] : ['className' => UstensilsTable::class];
        $this->Ustensils = $this->getTableLocator()->get('Ustensils', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ustensils);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UstensilsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
