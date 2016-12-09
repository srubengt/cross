<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Sets Controller
 *
 * @property \App\Model\Table\SetsTable $Sets
 */
class SetsController extends AppController
{

    public function isAuthorized($user)
    {
        // All registered users can logout

        switch ($user['role_id']){
            case 3: //User
                return true;
                break;
        }

        //  Return
        return parent::isAuthorized($user);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->autoRender = false; //No render, cargamos una vista u otra.
        $set = $this->Sets->newEntity();
        if ($this->request->is('post')) {
            $set = $this->Sets->patchEntity($set, $this->request->data);
            //Creamos array del set en función de lo recibido
            $data = $this->request->data;
            foreach (array_keys($data) as $key) {
                switch ($key){
                    case 'reps':
                        //No hacemos nada ya que llega un valo correcto
                        break;
                    case 'time':
                        //editamos el valor de data
                        if ($data['time']){
                            $data['time'] = '00:' . $data['time'];
                            $time = new Time($data['time']);
                            $set['time'] = new Time($data['time']);
                        }
                        break;
                    case 'weight':
                        break;
                    case 'distance':
                        break;
                    case 'calories':
                        break;
                }
            }

            if ($this->Sets->save($set)) {
                //$this->Flash->success(__('The set has been saved.'));
                if (isset($this->request->query['origin'])) {
                    return $this->redirect(['controller' => 'results','action' => 'edit', $set->result_id, 'origin' => $this->request->query['origin']]);
                }else{
                    return $this->redirect(['controller' => 'results','action' => 'edit', $set->result_id]);
                }
            } else {
                $this->Flash->error(__('The set could not be saved. Please, try again.'));
            }
        }else{
            $this->Flash->error(__('The set could not be saved. Please, try again.'));
            return $this->redirect(['controller' => 'results','action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Set id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $set = $this->Sets->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $set = $this->Sets->patchEntity($set, $this->request->data);
            if ($this->Sets->save($set)) {
                $this->Flash->success(__('The set has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The set could not be saved. Please, try again.'));
            }
        }
        $results = $this->Sets->Results->find('list', ['limit' => 200]);
        $this->set(compact('set', 'results'));
        $this->set('_serialize', ['set']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Set id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //Permitimos el método get por un problema con el boton postlink de Result->edit
        //$this->request->allowMethod(['post', 'delete']);
        $set = $this->Sets->get($id);
        $result_id = $set->result_id;

        if ($this->Sets->delete($set)) {
            //$this->Flash->success(__('The set has been deleted.'));
        } else {
            $this->Flash->error(__('The set could not be deleted. Please, try again.'));
        }
        if (isset($this->request->query['origin'])) {
            return $this->redirect(['controller' => 'results', 'action' => 'edit', $result_id, 'origin' => $this->request->query['origin']]);
        }else{
            return $this->redirect(['controller' => 'results', 'action' => 'edit', $result_id]);
        }

    }
}
