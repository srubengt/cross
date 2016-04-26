<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercisesWorkoutsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercisesWorkoutsTable Test Case
 */
class ExercisesWorkoutsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExercisesWorkoutsTable
     */
    public $ExercisesWorkouts;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exercises_workouts',
        'app.workouts',
        'app.exercises',
        'app.results',
        'app.exercises_results',
        'app.reservations',
        'app.wods',
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
        $config = TableRegistry::exists('ExercisesWorkouts') ? [] : ['className' => 'App\Model\Table\ExercisesWorkoutsTable'];
        $this->ExercisesWorkouts = TableRegistry::get('ExercisesWorkouts', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExercisesWorkouts);

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
