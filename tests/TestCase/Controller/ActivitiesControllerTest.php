<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ActivitiesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ActivitiesController Test Case
 */
class ActivitiesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activities',
        'app.sessions',
        'app.workouts',
        'app.wods',
        'app.wods_workouts',
        'app.reservations',
        'app.users',
        'app.roles',
        'app.dropins',
        'app.results',
        'app.exercises',
        'app.groups',
        'app.details',
        'app.units',
        'app.sets'
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
