<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dropins Controller
 *
 * @property \App\Model\Table\DropinsTable $Dropins
 */
class DropinsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $dropins = $this->paginate($this->Dropins);

        $this->set(compact('dropins'));
        $this->set('_serialize', ['dropins']);
    }

    /**
     * View method
     *
     * @param string|null $id Dropin id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dropin = $this->Dropins->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('dropin', $dropin);
        $this->set('_serialize', ['dropin']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dropin = $this->Dropins->newEntity();
        if ($this->request->is('post')) {
            $dropin = $this->Dropins->patchEntity($dropin, $this->request->data);
            if ($this->Dropins->save($dropin)) {
                $this->Flash->success(__('The dropin has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dropin could not be saved. Please, try again.'));
            }
        }
        $users = $this->Dropins->Users->find('list', ['limit' => 200]);
        $this->set(compact('dropin', 'users'));
        $this->set('_serialize', ['dropin']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dropin id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dropin = $this->Dropins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dropin = $this->Dropins->patchEntity($dropin, $this->request->data);
            if ($this->Dropins->save($dropin)) {
                $this->Flash->success(__('The dropin has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dropin could not be saved. Please, try again.'));
            }
        }
        $users = $this->Dropins->Users->find('list', ['limit' => 200]);
        $this->set(compact('dropin', 'users'));
        $this->set('_serialize', ['dropin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dropin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dropin = $this->Dropins->get($id);
        if ($this->Dropins->delete($dropin)) {
            $this->Flash->success(__('The dropin has been deleted.'));
        } else {
            $this->Flash->error(__('The dropin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
