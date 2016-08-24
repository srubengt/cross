<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypesTable Test Case
 */
class TypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TypesTable
     */
    public $Types;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.types',
        'app.wods',
        'app.scores',
        'app.exercises',
        'app.results',
        'app.reservations',
        'app.users',
        'app.roles',
        'app.sessions',
        'app.workouts',
        'app.exercises_workouts',
        'app.wods_workouts',
        'app.exercises_results',
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
        $config = TableRegistry::exists('Types') ? [] : ['className' => 'App\Model\Table\TypesTable'];
        $this->Types = TableRegistry::get('Types', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Types);

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
}
