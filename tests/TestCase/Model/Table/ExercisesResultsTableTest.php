<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExercisesResultsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExercisesResultsTable Test Case
 */
class ExercisesResultsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExercisesResultsTable
     */
    public $ExercisesResults;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exercises_results',
        'app.reservations',
        'app.exercises_workouts'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ExercisesResults') ? [] : ['className' => 'App\Model\Table\ExercisesResultsTable'];
        $this->ExercisesResults = TableRegistry::get('ExercisesResults', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExercisesResults);

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
