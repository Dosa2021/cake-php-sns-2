<?php
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => 'adminadmin',
                'role' => 'admin',
                'admin' => true,
                'created' => '2023-10-01 00:00:00',
                'modified' => '2023-10-01 00:00:00',
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
