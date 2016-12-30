<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\models\Bear;
use App\models\Fish;
use App\models\Tree;
use App\models\Picnic;
use App\User;
use App\Department;
use App\ProgramOffered;

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
          $this->call(UserSeeder::class);
          $this->command->info('User seeded!!'); // 
          $this->call(PermissionTableSeeder::class);
          $this->command->info('Permission app seeds finished.');
    }
}

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear our database ------------------------------------------
        DB::table('users')->delete();
        

        $first_user = User::create(array(
            'name'         => 'Muhammad Nauman',
            'email'         => 'mhmmd.nauman@gmail.com',
            'password' => bcrypt('12345678'),
        ));

        
        
        $this->command->info('Users are seeded!');
        
        // now seed the departments
        DB::table('department')->delete();
        

        $first_dpt = Department::create(array(
            'department_name'         => 'Computer Science',
            'contact'         => '0313',
            'status' => 'Active',
            'hod_id' => $first_user->id,
            'entered_id' => $first_user->id,
        ));
        
        $this->command->info('Department are seeded!');
        
        // now seed the programs
        DB::table('programs_offered')->delete();
        

        $first_program = ProgramOffered::create(array(
            'program_name'      => 'BSCS',
            'duration'          => '4',
            'code'              =>'BS',
            'status'            => 'Active',
            'incharge_id'       => $first_user->id,
            'entered_id'        => $first_user->id,
            'department_id'     => $first_dpt->id,
        ));
        $this->command->info('Program are seeded!');
        
    }


}
class BearAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear our database ------------------------------------------
        DB::table('bears')->delete();
        DB::table('fish')->delete();
        DB::table('picnics')->delete();
        DB::table('trees')->delete();
        DB::table('bears_picnics')->delete();

        // seed our bears table -----------------------
        // we'll create three different bears

        // bear 1 is named Lawly. She is extremely dangerous. Especially when hungry.
    
        $bearLawly = Bear::create(array(
            'name'         => 'Lawly',
            'type'         => 'Grizzly',
            'danger_level' => 8
        ));

        // bear 2 is named Cerms. He has a loud growl but is pretty much harmless.
        $bearCerms = Bear::create(array(
            'name'         => 'Cerms',
            'type'         => 'Black',
            'danger_level' => 4
        ));

        // bear 3 is named Adobot. He is a polar bear. He drinks vodka.
        $bearAdobot = Bear::create(array(
            'name'         => 'Adobot',
            'type'         => 'Polar',
            'danger_level' => 3
        ));

        $this->command->info('The bears are alive!');

        // seed our fish table ------------------------
        // our fish wont have names... because theyre going to be eaten

        // we will use the variables we used to create the bears to get their id
        
        Fish::create(array(
            'weight'  => 5,
            'bear_id' => $bearLawly->id
        ));
        Fish::create(array(
            'weight'  => 12,
            'bear_id' => $bearCerms->id
        ));
        Fish::create(array(
            'weight'  => 4,
            'bear_id' => $bearAdobot->id
        ));
        
        $this->command->info('They are eating fish!');

        // seed our trees table ---------------------
        Tree::create(array(
            'type'    => 'Redwood',
            'age'     => 500,
            'bear_id' => $bearLawly->id
        ));
        Tree::create(array(
            'type'    => 'Oak',
            'age'     => 400,
            'bear_id' => $bearLawly->id
        ));

        $this->command->info('Climb bears! Be free!');

        // seed our picnics table ---------------------

        // we will create one picnic and apply all bears to this one picnic
        $picnicYellowstone = Picnic::create(array(
            'name'        => 'Yellowstone',
            'taste_level' => 6
        ));
        $picnicGrandCanyon = Picnic::create(array(
            'name'        => 'Grand Canyon',
            'taste_level' => 5
        ));
        
        // link our bears to picnics ---------------------
        // for our purposes we'll just add all bears to both picnics for our many to many relationship
        $bearLawly->picnics()->attach($picnicYellowstone->id);
      
        /* $bearLawly->picnics()->attach($picnicGrandCanyon->id);

        $bearCerms->picnics()->attach($picnicYellowstone->id);
        $bearCerms->picnics()->attach($picnicGrandCanyon->id);

        $bearAdobot->picnics()->attach($picnicYellowstone->id);
        $bearAdobot->picnics()->attach($picnicGrandCanyon->id);
        */
        $this->command->info('They are terrorizing picnics!');

    }


}

