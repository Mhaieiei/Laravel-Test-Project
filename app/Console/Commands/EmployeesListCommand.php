<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmployeesListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     //declear command, limit and option
    protected $signature = 'employee:list {limit=5} {--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List Employee of the System';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $limit = $this->argument('limit');
        $admin = $this->option('admin');

        if($admin){
          $password = $this->secret('Please enter password');
          if($password =='12345'){
            $employees = \App\Employee::limit($limit)->get();
            $headers = ['#','First Name','Last Name','Gender'];
          }else{
            $this->info('Your password is incorrect');
            exit;
          }

        }else{
          $employees = \App\Employee::select('firstname','lastname')->limit($limit)->get();
          $headers = ['First Name','Last Name'];
        }

        $this -> table($headers,$employees);


        //
    }
}
