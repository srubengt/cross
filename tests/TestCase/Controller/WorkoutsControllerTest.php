<?php
namespace App\Test\TestCase\Controller;

use App\Controller\WorkoutsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\WorkoutsController Test Case
 */
class WorkoutsControllerTest extends IntegrationTestCase
{

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
