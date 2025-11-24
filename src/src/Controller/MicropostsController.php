<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Microposts Controller
 *
 * @property \App\Model\Table\MicropostsTable $Microposts
 *
 * @method \App\Model\Entity\Micropost[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MicropostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['User'],
        ];
        $microposts = $this->paginate($this->Microposts);

        $this->set(compact('microposts'));
    }

    /**
     * View method
     *
     * @param string|null $id Micropost id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $micropost = $this->Microposts->get($id, [
            'contain' => ['User'],
        ]);

        $this->set('micropost', $micropost);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $micropost = $this->Microposts->newEntity();
        if ($this->request->is('post')) {
            $micropost = $this->Microposts->patchEntity($micropost, $this->request->getData());
            if ($this->Microposts->save($micropost)) {
                $this->Flash->success(__('The micropost has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micropost could not be saved. Please, try again.'));
        }
        $user = $this->Microposts->User->find('list', ['limit' => 200]);
        $this->set(compact('micropost', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Micropost id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $micropost = $this->Microposts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $micropost = $this->Microposts->patchEntity($micropost, $this->request->getData());
            if ($this->Microposts->save($micropost)) {
                $this->Flash->success(__('The micropost has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micropost could not be saved. Please, try again.'));
        }
        $user = $this->Microposts->User->find('list', ['limit' => 200]);
        $this->set(compact('micropost', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Micropost id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $micropost = $this->Microposts->get($id);
        if ($this->Microposts->delete($micropost)) {
            $this->Flash->success(__('The micropost has been deleted.'));
        } else {
            $this->Flash->error(__('The micropost could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
