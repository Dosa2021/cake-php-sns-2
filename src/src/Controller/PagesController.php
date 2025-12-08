<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use App\Model\Table\MicropostsTable;

use Cake\ORM\TableRegistry;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $users_test = TableRegistry::getTableLocator()->get('Users');

        // $query = $users_test->find();

        // foreach ($query as $row) {
        //     echo $row;
        // }

        // クエリの直接実行
        // $query = $users_test->find()->all();
        // $query = $users_test->find()->toList();
        // debug($query);

        // カラムから値リストを取得する¶
        // $query = $users_test->find()->extract('name');
        // debug($query);
        // foreach ($query as $title) {
        //     echo $title;
        // }

        // $query = $users_test->find('list');
        // debug($query);
        // foreach ($query as $id => $title) {
        //     echo "$id : $title";
        // }

        // クエリーは Collection オブジェクトである
        $keyValueList = $users_test
            ->find()
            ->map(function ($row) {
                $row = 'fugafuga';
                return $row;
            });        

        $MicropostsTable = new MicropostsTable;
        $users = $this->loadModel('Users');
        $micropost = $MicropostsTable->newEntity();
        $feed_items = (object)[];
        $relations_users = (object)[];

        if ($this->Auth->user()) {
            $relations_users = $users->get($this->Auth->user('id'), [
                'contain' => ['Following', 'Followers']
            ]);
        }

        $hoge = $users->find();
        $query = $hoge
            ->contain('Microposts')
            ->select([
                'Users.id',
                'email',
                'hoge' => $hoge->func()->coalesce([
                    'Users.name' => 'identifier',
                    'Users.email' => 'identifier'
                ])
            ])
            ->where(['id' => $this->Auth->user('id')]);

        foreach ($query as $article) {
            $feed_items = $article->microposts;
        }

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));
        $this->set('feed_items', $feed_items);
        $this->set('micropost', $micropost);
        $this->set('relations_users', $relations_users);

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function export()
    {
        $this->response->type('csv'); // CSV header設定
        $this->response->download('users.csv'); // ダウンロードファイル名

        $users = [
            ['1', 'a', 'a@com'],
            ['2', 'b', 'b@com'],
        ];

        $csv = [];
        $csv[] = ['ID', '名前', 'メール'];

        foreach ($users as $user) {
            $csv[] = [
                $user[0],
                $user[1],
                $user[2]
            ];
        }

        // CSV文字列を生成
        $output = '';
        foreach ($csv as $line) {
            $output .= implode(',', $line) . "\n";
        }

        $response = $this->response
            ->withType('csv')
            ->withDownload('users.csv')
            ->withStringBody($output);

        return $response;
    }
}
