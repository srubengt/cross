<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WorkoutsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WorkoutsTable Test Case
 */
class WorkoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WorkoutsTable
     */
    public $Workouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.workouts',
        'app.sessions',
        'app.reservations',
        'app.users',
        'app.roles',
        'app.exercises_results',
        'app.exercises_workouts',
        'app.exercises',
        'app.results',
        'app.sessions_users',
        'app.wods',
        'app.scores',
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
        $config = TableRegistry::exists('Workouts') ? [] : ['className' => 'App\Model\Table\WorkoutsTable'];
        $this->Workouts = TableRegistry::get('Workouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Workouts);

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
