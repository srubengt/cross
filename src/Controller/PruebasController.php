<?php
namespace App\Controller;

use App\Controller\AppController;

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
}