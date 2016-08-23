<?php
use Illuminate\Database\Seeder;
use database\seeds\BearAppSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
    
          Eloquent::unguard();
          $this->call(BearAppSeeder::class);
          $this->command->info('Bear app seeds finished.'); // show information in the command line after everything is run
   
    }
}

