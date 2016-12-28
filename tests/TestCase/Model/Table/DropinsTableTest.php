<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DropinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DropinsTable Test Case
 */
class DropinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DropinsTable
     */
    public $Dropins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dropins',
        'app.users',
        'app.roles',
        'app.reservations',
        'app.sessions',
        'app.workouts',
        'app.wods',
        'app.wods_workouts',
        'app.results',
        'app.exercises',
        'app.groups',
        'app.details',
        'app.units',
        'app.sets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dropins') ? [] : ['className' => 'App\Model\Table\DropinsTable'];
        $this->Dropins = TableRegistry::get('Dropins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dropins);

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
