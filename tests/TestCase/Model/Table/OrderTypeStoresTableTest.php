<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderTypeStoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderTypeStoresTable Test Case
 */
class OrderTypeStoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderTypeStoresTable
     */
    public $OrderTypeStores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.order_type_stores',
        'app.store_order_types',
        'app.stores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderTypeStores') ? [] : ['className' => OrderTypeStoresTable::class];
        $this->OrderTypeStores = TableRegistry::getTableLocator()->get('OrderTypeStores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderTypeStores);

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
