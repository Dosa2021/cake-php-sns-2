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
use Cake\Log\Log;
use App\Model\Table\MicropostsTable;

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
        $MicropostsTable = new MicropostsTable;
        $users = $this->loadModel('Users');
        $user_informations = $this->getTableLocator()->get('UserInformations');
        $micropost = $MicropostsTable->newEntity();
        $feed_items = (object)[];
        $relations_users = (object)[];
        $periods = [];

        if ($this->Auth->user()) {
            $relations_users = $users->get($this->Auth->user('id'), [
                'contain' => ['Following', 'Followers']
            ]);
        }

        $query_user_informations = $user_informations
            ->find()
            ->select(['period'])
            ->all();
        foreach ($query_user_informations as $article) {
            $periods = array_merge($periods, array($article->period => $article->period));
        }

        $query = $users->find()->contain('Microposts')->where(['id' => $this->Auth->user('id')]);
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
        $this->set('periods', $periods);

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function exportcsv()
    {
        $period = $this->request->getData('period');
        $csv_content = [];
        $user_informations = $this->getTableLocator()->get('UserInformations');
        $query_user_informations = $user_informations
            ->find()
            ->where(['period' => $period])
            ->all();

        foreach ($query_user_informations as $article) {
            array_push($csv_content, $article->period);
            array_push($csv_content, $article->count_register_user);
        }

        $this->response->type('csv'); // CSV header設定
        $this->response->download("{$period}.csv"); // ダウンロードファイル名

        $users = [
            $csv_content
        ];

        $csv = [];
        $csv[] = ['年月', '新規入会数'];

        foreach ($users as $user) {
            $csv[] = [
                $user[0],
                $user[1]
            ];
        }

        // CSV文字列を生成
        $output = '';
        foreach ($csv as $line) {
            $output .= implode(',', $line) . "\n";
        }

        $response = $this->response
            ->withType('csv')
            ->withDownload("{$period}.csv")
            ->withStringBody($output);
        return $response;
    }
}
