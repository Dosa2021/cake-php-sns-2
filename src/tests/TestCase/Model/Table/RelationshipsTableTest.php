<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RelationshipsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RelationshipsTable Test Case
 */
class RelationshipsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RelationshipsTable
     */
    public $Relationships;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Relationships',
        'app.Followers',
        'app.Followeds',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Relationships') ? [] : ['className' => RelationshipsTable::class];
        $this->Relationships = TableRegistry::getTableLocator()->get('Relationships', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Relationships);

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
