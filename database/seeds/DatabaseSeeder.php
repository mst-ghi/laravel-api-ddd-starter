<?php

class DatabaseSeeder extends DBSeeder
{
    protected $all_step = 2;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->start();
        $this->call(AclSeeder::class);
        $this->end();

        $dumps = [
            'admins',
            'role_admin',
        ];

        $this->start();
        foreach ($dumps as $dump) {
            $this->dumpSqlFile($dump);
        }
        $this->end();
    }
}
