<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;

/**
 * Exercises Controller
 *
 * @property \App\Model\Table\ExercisesTable $Exercises
 */
class PruebasController extends AppController{
    
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Upload');
    }
    
    //Functión para cargar el plugin de jquery FullCalendar
    public function calendar(){
        //Mostramos el plugin de calendario.
    }
    
    public function ajax(){
        //Cargamos la vista para ejecurtar una llamada ajax
    }
    
    public function table(){
        //Cargamos la vista de dataTable
    }

    public function pswp(){
        //Cargamos la vista de pswd
    }
    
    
    public function subcategoria($val){
        /*$this->autoRender = false; // We don't render a view in this example
	    $this->request->allowMethod('ajax'); // No direct access via browser URL
	
    	$data = array(1, 2, 3);
	    return $data;*/
        
        $this->autoRender = false;
        
        $this->request->allowMethod('ajax');
        
        $this->viewBuilder()->layout('ajax');
        
        // aquí la lógica que uséis para obtener datos de la <a href="https://www.pedroventura.com/tag/base-de-datos/">base de datos</a>
        // y generar un array con todas las categorías
        // por lo normal y rápido será usar la funcion find con el primer parámetro list para que lo devuelva formateado con el identificador de cada opcion como key de los nodos del array

        $subcategoria = "Hola mundo";
        //$subcategorias = $this->ArticuloSubcategoria->find('list',array('conditions' => array('ArticuloSubcategoria.categoria_id' => $id), 'fields' => 'nombre_subcategoria'));
        $this->set('subcategoria',$subcategoria);
    }
    
    public function myaction (){
        
    }
    
    public function upload()
    {
        if ( !empty( $this->request->data ) ) {
            $this->Upload->send($this->request->data['uploadfile']);
        }
    }

    public function testCollection(){
        $items = [
            ['id' => 1, 'parent_id' => null, 'name' => 'Birds'],
            ['id' => 2, 'parent_id' => 1, 'name' => 'Land Birds'],
            ['id' => 3, 'parent_id' => 1, 'name' => 'Eagle'],
            ['id' => 4, 'parent_id' => 1, 'name' => 'Seagull'],
            ['id' => 5, 'parent_id' => 6, 'name' => 'Clown Fish'],
            ['id' => 6, 'parent_id' => null, 'name' => 'Fish'],
        ];

        $items2 = [
            ['cod' => 'A', 'codintegr' => 'A', 'parent' => null, 'name' => 'CNAE A'],
            ['cod' => '01', 'codintegr' => 'A01', 'parent' => 'A', 'name' => 'CNAE A'],
            ['cod' => '011', 'codintegr' => 'A011', 'parent' => '01', 'name' => 'CNAE A'],
            ['cod' => '0111', 'codintegr' => 'A0111', 'parent' => '011', 'name' => 'CNAE A'],
            ['cod' => '0112', 'codintegr' => 'A0112', 'parent' => '011', 'name' => 'CNAE A'],
            ['cod' => '012', 'codintegr' => 'A012', 'parent' => '01', 'name' => 'CNAE A'],
            ['cod' => '0121', 'codintegr' => 'A0121', 'parent' => '012', 'name' => 'CNAE A'],
            ['cod' => '0122', 'codintegr' => 'A0122', 'parent' => '012', 'name' => 'CNAE A']
        ];


        $collection = new Collection($items2);

        debug($collection->nest('cod', 'parent')->toArray());

        exit;
    }
}