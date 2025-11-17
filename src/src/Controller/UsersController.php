<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $errors = $user->getErrors();
            if (isset($errors['email'])) {
                foreach($errors['email'] as $error){
                    $this->Flash->error('【メールアドレス】' . $error);
                }
            }
            if (isset($errors['password'])) {
                foreach($errors['password'] as $error){
                    $this->Flash->error('【パスワード】'. $error);
                }
            }
            if ($this->Users->save($user)) {
                $this->Flash->success('Add successful');
                return $this->redirect(['action'=>'view', $user->id]);
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
