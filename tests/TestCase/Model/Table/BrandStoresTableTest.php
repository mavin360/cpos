<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrandStoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrandStoresTable Test Case
 */
class BrandStoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrandStoresTable
     */
    public $BrandStores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brand_stores',
        'app.brands',
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
        $config = TableRegistry::getTableLocator()->exists('BrandStores') ? [] : ['className' => BrandStoresTable::class];
        $this->BrandStores = TableRegistry::getTableLocator()->get('BrandStores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BrandStores);

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
