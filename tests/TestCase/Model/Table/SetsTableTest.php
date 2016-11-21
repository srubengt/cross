<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SetsTable Test Case
 */
class SetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SetsTable
     */
    public $Sets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sets',
        'app.results',
        'app.exercises',
        'app.groups',
        'app.details',
        'app.units',
        'app.users',
        'app.roles',
        'app.reservations',
        'app.sessions',
        'app.workouts',
        'app.exercises_workouts',
        'app.wods',
        'app.exercises_wods',
        'app.wods_workouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Sets') ? [] : ['className' => 'App\Model\Table\SetsTable'];
        $this->Sets = TableRegistry::get('Sets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Sets);

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
