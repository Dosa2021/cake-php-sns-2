<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('Add successful');
                return $this->redirect(['action'=>'add']);
            } else {
              $this->Flash->error('Add error');
            }
        }
    }

    public function index()
    {
        $users = $this->Users->find('all');
        $this->set('users', $users);
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id);
        $this->set('user', $user);
    }
}
