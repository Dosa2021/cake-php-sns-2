<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MicropostsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MicropostsTable Test Case
 */
class MicropostsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MicropostsTable
     */
    public $Microposts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Microposts',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Microposts') ? [] : ['className' => MicropostsTable::class];
        $this->Microposts = TableRegistry::getTableLocator()->get('Microposts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Microposts);

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
}
