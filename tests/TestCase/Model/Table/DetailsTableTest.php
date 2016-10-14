<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetailsTable Test Case
 */
class DetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetailsTable
     */
    public $Details;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.details',
        'app.units'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Details') ? [] : ['className' => 'App\Model\Table\DetailsTable'];
        $this->Details = TableRegistry::get('Details', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Details);

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
