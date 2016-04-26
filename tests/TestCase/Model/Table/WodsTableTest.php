<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WodsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WodsTable Test Case
 */
class WodsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WodsTable
     */
    public $Wods;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        'app.wods_workouts',
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
        $config = TableRegistry::exists('Wods') ? [] : ['className' => 'App\Model\Table\WodsTable'];
        $this->Wods = TableRegistry::get('Wods', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Wods);

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
