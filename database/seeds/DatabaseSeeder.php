<?php

use Illuminate\Database\Seeder;
use App\Ramo;
use App\LinhaFormacao;
use App\User;
use App\Associado;
use App\UEL;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->command->info('Users table seeded!');

        $this->call('RamoTableSeeder');
        $this->command->info('Ramo table seeded!');

        $this->call('LinhaFormacaoTableSeeder');
        $this->command->info('LinhaFormacao table seeded!');

        //DB::table('associado')->delete();
        //factory(Associado::class, 100)->create();
        //$this->command->info('Associado table seeded!');

        DB::table('uel')->delete();
        factory(UEL::class, 100)->create();
        $this->command->info('UEL table seeded!');
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'admin',
            'email' => 'valezin@gmail.com',
            'password' => bcrypt('EscoteirosSP'),
            'super_admin' => 1,
            'remember_token' => str_random(10),
        ]);
    }

}

class RamoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ramo')->delete();

        Ramo::create(['nome' => 'Lobinho', 'sigla' => 'L']);
        Ramo::create(['nome' => 'Escoteiro', 'sigla' => 'E']);
        Ramo::create(['nome' => 'Sênior', 'sigla' => 'S']);
        Ramo::create(['nome' => 'Pioneiro', 'sigla' => 'P']);
    }

    }

class LinhaFormacaoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('linha_formacao')->delete();

        LinhaFormacao::create(['nome' => 'Dirigente', 'sigla' => 'D']);
        LinhaFormacao::create(['nome' => 'Escotista', 'sigla' => 'E']);
    }

}
