<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StoreOrderTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StoreOrderTypesTable Test Case
 */
class StoreOrderTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StoreOrderTypesTable
     */
    public $StoreOrderTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.store_order_types',
        'app.stores',
        'app.order_type_stores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StoreOrderTypes') ? [] : ['className' => StoreOrderTypesTable::class];
        $this->StoreOrderTypes = TableRegistry::getTableLocator()->get('StoreOrderTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StoreOrderTypes);

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
