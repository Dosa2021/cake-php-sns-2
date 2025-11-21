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
            if (isset($errors['name'])) {
                foreach($errors['name'] as $error){
                    $this->Flash->error('【名前】' . $error);
                }
            }
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

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        $this->set('user', $user);

        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $errors = $user->getErrors();
            if (isset($errors['name'])) {
                foreach($errors['name'] as $error){
                    $this->Flash->error('【名前】' . $error);
                }
            }
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

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['action'=>'view', $this->Auth->user('id')]);
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
