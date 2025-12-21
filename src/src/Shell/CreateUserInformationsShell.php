<?php

namespace App\Shell;

use Cake\Console\Shell;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class CreateUserInformationsShell extends Shell
{
    public function main()
    {
        $users = $this->getTableLocator()->get('Users');
        $user_informations_table = TableRegistry::getTableLocator()->get('UserInformations');
        $user_information = $user_informations_table->newEntity();

        $query = $users->find()
            ->where(function ($exp, $q) {
                return $exp->eq(
                    $q->func()->date_format([
                        'created' => 'identifier',
                        "'%Y-%m'" => 'literal'
                    ]),
                    // TODO:
                    '2025-11'
                );
            })->all();

        // TODO:
        $user_information->period = '2025/11';
        $user_information->count_register_user = count($query);
        // TODO:
        $user_information->created = '2025-12-21 03:10:24';
        $user_information->modified = '2025-12-21 03:10:24';

        if ($user_informations_table->save($user_information)) {
            $this->out('CreateUserInformations-save----------');
        }
    }
}