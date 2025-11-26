<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }

    public $paginate = [
        'limit' => 5,
        'order' => [
            'Users.id' => 'asc'
        ]
    ];

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->request->data('admin', false);
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $errors = $user->getErrors();
            $this->error_handling($errors);

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
        $this->set('users', $this->paginate());
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id);
        $microposts = (object)[];
        $query = $this->Users->find()->contain('Microposts')->where(['id' => $id ]);
        foreach ($query as $article) {
            $microposts = $article->microposts;
        }

        $this->set('user', $user);
        $this->set('microposts', $microposts);
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        $this->correct_user($user);
        $this->set('user', $user);

        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $errors = $user->getErrors();
            $this->error_handling($errors);

            if ($this->Users->save($user)) {
                $this->Flash->success('Add successful');
                return $this->redirect(['action'=>'view', $user->id]);
            } else {
              $this->Flash->error('Add error');
            }
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The {0} article has been deleted.', $user->name));
            return $this->redirect(['action' => 'index']);
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

    private function error_handling($errors = null)
    {
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
    }

    private function correct_user($user = null)
    {
        if (!($user->id === $this->Auth->user('id'))) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
    }
}
