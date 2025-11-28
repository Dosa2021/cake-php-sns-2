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
        $is_following = $this->is_following($this->Auth->user('id'), $user->id);
        $query = $this->Users->find()->contain('Microposts')->where(['id' => $id ]);

        foreach ($query as $article) {
            $microposts = $article->microposts;
        }

        $this->set('user', $user);
        $this->set('microposts', $microposts);
        $this->set('is_following', $is_following);
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

    public function following($id = null)
    {
        $title = "Following";
        $user = $this->Users->get($id);
        $relations_users = $this->Users->get($id, [
            'contain' => ['Following', 'Followers']
        ]);

        $this->set('title', $title);
        $this->set('user', $user);
        $this->set('relations_users', $relations_users);
        $this->render('/Users/show_follow');
    }

    // TODO: 実装
    // public function followers($id = null)
    // {
    //     $this->render('/Users/show_follow');
    // }

    private function is_following($user_id, $target_id)
    {
        $Relationships = $this->loadModel('Relationships');
        return $Relationships->exists([
            'follower_id' => $user_id,
            'followed_id' => $target_id
        ]);
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
