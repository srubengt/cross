<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercisesWodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercisesWodsTable Test Case
 */
class ExercisesWodsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExercisesWodsTable
     */
    public $ExercisesWods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exercises_wods',
        'app.wods',
        'app.exercises',
        'app.results',
        'app.exercises_results',
        'app.reservations',
        'app.exercises_workouts',
        'app.workouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExercisesWods') ? [] : ['className' => 'App\Model\Table\ExercisesWodsTable'];
        $this->ExercisesWods = TableRegistry::get('ExercisesWods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExercisesWods);

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
