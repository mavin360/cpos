<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderItemToppingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderItemToppingsTable Test Case
 */
class OrderItemToppingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderItemToppingsTable
     */
    public $OrderItemToppings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.order_item_toppings',
        'app.orders',
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
        $config = TableRegistry::getTableLocator()->exists('OrderItemToppings') ? [] : ['className' => OrderItemToppingsTable::class];
        $this->OrderItemToppings = TableRegistry::getTableLocator()->get('OrderItemToppings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderItemToppings);

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
