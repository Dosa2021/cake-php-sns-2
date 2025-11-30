<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Relationships Controller
 *
 * @property \App\Model\Table\RelationshipsTable $Relationships
 *
 * @method \App\Model\Entity\Relationship[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RelationshipsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    // public function index()
    // {
    //     $this->paginate = [
    //         'contain' => ['Followers', 'Followeds', 'Followed', 'Follower'],
    //     ];
    //     $relationships = $this->paginate($this->Relationships);

    //     $this->set(compact('relationships'));
    // }

    /**
     * View method
     *
     * @param string|null $id Relationship id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $relationship = $this->Relationships->get($id, [
    //         'contain' => ['Followers', 'Followeds', 'Followed', 'Follower'],
    //     ]);

    //     $this->set('relationship', $relationship);
    // }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    // public function add()
    // {
    //     $relationship = $this->Relationships->newEntity();
    //     if ($this->request->is('post')) {
    //         $relationship = $this->Relationships->patchEntity($relationship, $this->request->getData());
    //         if ($this->Relationships->save($relationship)) {
    //             $this->Flash->success(__('The relationship has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The relationship could not be saved. Please, try again.'));
    //     }
    //     $followers = $this->Relationships->Followers->find('list', ['limit' => 200]);
    //     $followeds = $this->Relationships->Followeds->find('list', ['limit' => 200]);
    //     $followed = $this->Relationships->Followed->find('list', ['limit' => 200]);
    //     $follower = $this->Relationships->Follower->find('list', ['limit' => 200]);
    //     $this->set(compact('relationship', 'followers', 'followeds', 'followed', 'follower'));
    // }

    /**
     * Edit method
     *
     * @param string|null $id Relationship id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function edit($id = null)
    // {
    //     $relationship = $this->Relationships->get($id, [
    //         'contain' => [],
    //     ]);
    //     if ($this->request->is(['patch', 'post', 'put'])) {
    //         $relationship = $this->Relationships->patchEntity($relationship, $this->request->getData());
    //         if ($this->Relationships->save($relationship)) {
    //             $this->Flash->success(__('The relationship has been saved.'));

    //             return $this->redirect(['action' => 'index']);
    //         }
    //         $this->Flash->error(__('The relationship could not be saved. Please, try again.'));
    //     }
    //     $followers = $this->Relationships->Followers->find('list', ['limit' => 200]);
    //     $followeds = $this->Relationships->Followeds->find('list', ['limit' => 200]);
    //     $followed = $this->Relationships->Followed->find('list', ['limit' => 200]);
    //     $follower = $this->Relationships->Follower->find('list', ['limit' => 200]);
    //     $this->set(compact('relationship', 'followers', 'followeds', 'followed', 'follower'));
    // }

    /**
     * Delete method
     *
     * @param string|null $id Relationship id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $relationship = $this->Relationships->get($id);
    //     if ($this->Relationships->delete($relationship)) {
    //         $this->Flash->success(__('The relationship has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The relationship could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function follow($id = null)
    {
        $userId = $this->Auth->user('id');
        $relationship = $this->Relationships->newEntity();

        if ($this->request->is('post')) {
            $relationship = $this->Relationships->patchEntity($relationship, [
                'follower_id' => $userId,
                'followed_id' => $id,
            ]);
            
            if ($this->Relationships->save($relationship)) {                
                $this->Flash->success(__('The relationship has been saved.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'view', $userId]);
            }
            $this->Flash->error(__('The relationship could not be saved. Please, try again.'));
        }

        // $followers = $this->Relationships->Followers->find('list', ['limit' => 200]);
        // $followeds = $this->Relationships->Followeds->find('list', ['limit' => 200]);
        // $followed = $this->Relationships->Followed->find('list', ['limit' => 200]);
        // $follower = $this->Relationships->Follower->find('list', ['limit' => 200]);
        // $this->set(compact('relationship', 'followers', 'followeds', 'followed', 'follower'));
        return $this->redirect(['controller' => 'Users', 'action' => 'view', $userId]);
    }
}
