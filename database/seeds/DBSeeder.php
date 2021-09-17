<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DBSeeder extends Seeder
{
    /**
     * Set the number of steps to complete the process
     */
    protected $all_step = 0;

    /**
     * title DB Insert output
     */
    const DB_INSERT = "DB Insert: ";

    /**
     * title Steps output
     */
    protected $step;

    /*
     * start number of steps
     */
    public $nextStep = 1;

    /**
     * table name for seeders
     */
    public $table;

    /**
     * if foreign key checks, when insert table action executed
     *
     * @var bool $foreignKeyChecks
     */
    public $foreignKeyChecks = false;


    /**
     * print start output
     */
    public function start()
    {
        $this->info(" ");
        $this->next();
    }

    /**
     * print next output
     */
    public function next()
    {
        $this->warn("SeederSteps {$this->nextStep} -> {$this->all_step} -------------------------------------------------");
        $this->nextStep++;
    }

    public function dumpSqlFile(String $file)
    {
        $path = "database/seeds/sql/{$file}.sql";
        DB::unprepared(file_get_contents($path));
        $this->writeln('DB Insert:', "{$file} table");
    }

    /**
     * insert into database
     *
     * @param string $table
     * @param        $message
     * @param bool   $wantEmptyTable
     * @param array  ...$data
     */
    public function dbInsert(string $table, $message, bool $wantEmptyTable, array ...$data)
    {
        if ($wantEmptyTable) {
            if ($this->foreignKeyChecks) {
                $this->emptyTable($table, true);
            } else {
                $this->emptyTable($table);
            }
        }

        foreach ($data as $d) {
            DB::table($table)->insert($d);
        }

        if (!is_null($message)) {
            $this->writeln(self::DB_INSERT, $message);
            $this->end();
        }

    }

    /**
     * empty table in database
     *
     * @param string $table
     * @param bool   $setForeignKeyChecks
     */
    public function emptyTable(string $table, bool $setForeignKeyChecks = false)
    {
        if ($setForeignKeyChecks) {
            $this->foreignKeyChecks();
        }

        DB::table($table)->truncate();
    }

    /**
     * if foreign key checks, when insert table action executed
     */
    public function foreignKeyChecks()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    /**
     * print end output
     */
    public function end()
    {
        $this->warn("--------------------------------------------------------------------");
        $this->info(" ");
    }

    /**
     * writeln output action
     *
     * @param string $title
     * @param string $message
     */
    public function writeln(string $title, string $message)
    {
        $this->command->getOutput()->writeln("<info>$title</info> $message");
    }

    /**
     * info output action
     *
     * @param string $message
     */
    public function info(string $message)
    {
        $this->command->info($message);
    }

    /**
     * warn output action
     *
     * @param string $message
     */
    public function warn(string $message)
    {
        $this->command->warn($message);
    }

}
