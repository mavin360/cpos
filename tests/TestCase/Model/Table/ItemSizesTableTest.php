<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemSizesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemSizesTable Test Case
 */
class ItemSizesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemSizesTable
     */
    public $ItemSizes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_sizes',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ItemSizes') ? [] : ['className' => ItemSizesTable::class];
        $this->ItemSizes = TableRegistry::getTableLocator()->get('ItemSizes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemSizes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
