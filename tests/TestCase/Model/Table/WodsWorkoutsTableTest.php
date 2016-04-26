<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WodsWorkoutsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WodsWorkoutsTable Test Case
 */
class WodsWorkoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WodsWorkoutsTable
     */
    public $WodsWorkouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.wods_workouts',
        'app.wods',
        'app.scores',
        'app.exercises',
        'app.results',
        'app.sessions_users',
        'app.exercises_results',
        'app.reservations',
        'app.users',
        'app.roles',
        'app.sessions',
        'app.workouts',
        'app.exercises_workouts',
        'app.exercises_wods'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('WodsWorkouts') ? [] : ['className' => 'App\Model\Table\WodsWorkoutsTable'];
        $this->WodsWorkouts = TableRegistry::get('WodsWorkouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->WodsWorkouts);

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
