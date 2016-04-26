<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ResultsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ResultsController Test Case
 */
class ResultsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.results',
        'app.sessions_users',
        'app.exercises',
        'app.exercises_results',
        'app.reservations',
        'app.users',
        'app.sessions',
        'app.exercises_workouts',
        'app.workouts',
        'app.wods',
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
