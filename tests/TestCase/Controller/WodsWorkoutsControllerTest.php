<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WodsWorkoutsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WodsWorkoutsController Test Case
 */
class WodsWorkoutsControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
