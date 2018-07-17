<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StoreTimesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StoreTimesTable Test Case
 */
class StoreTimesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StoreTimesTable
     */
    public $StoreTimes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.store_times',
        'app.store_locations'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StoreTimes') ? [] : ['className' => StoreTimesTable::class];
        $this->StoreTimes = TableRegistry::getTableLocator()->get('StoreTimes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StoreTimes);

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
