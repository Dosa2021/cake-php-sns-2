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
        $today = date("Y-m");
        $now = date("{$today}-d H:i:s");

        $query = $users->find()
            ->where(function ($exp, $q) use ($today) {
                return $exp->eq(
                    $q->func()->date_format([
                        'created' => 'identifier',
                        "'%Y-%m'" => 'literal'
                    ]),
                    $today
                );
            })->all();

        $user_information->period = $today;
        $user_information->count_register_user = count($query);
        $user_information->created = $now;
        $user_information->modified = $now;

        if ($user_informations_table->save($user_information)) {
            $this->out('CreateUserInformations-save----------');
        }
    }
}