<?php

use Illuminate\Database\Seeder;
use App\Ramo;
use App\LinhaFormacao;
use App\User;
use App\Associado;
use App\UEL;
use App\Grade;
use App\TipoCurso;
use App\Curso;

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

        $this->call('TipoCursoTableSeeder');
        $this->command->info('TipoCurso table seeded!');

        $this->call('GradeTableSeeder');
        $this->command->info('Grade table seeded!');

        $this->call('CursoTableSeeder');
        $this->command->info('Curso table seeded!');

        DB::table('associado')->delete();
        factory(Associado::class, 100)->create();
        $this->command->info('Associado table seeded!');

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

class TipoCursoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('tipo_curso')->delete();

        TipoCurso::create(['nome' => 'Preliminar', 'sigla' => 'CP']);
        TipoCurso::create(['nome' => 'Módulo de Aperfeiçoamento', 'sigla' => 'MA']);
        TipoCurso::create(['nome' => 'Curso Técnico', 'sigla' => 'CT']);
        TipoCurso::create(['nome' => 'Curso Técnico de Ramo', 'sigla' => 'CTR']);
        TipoCurso::create(['nome' => 'Curso Básico', 'sigla' => 'CB']);
        TipoCurso::create(['nome' => 'Curso Avançado', 'sigla' => 'CA']);
    }

}

class GradeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('grade')->delete();

        Grade::create([
            'nome' => 'Preliminar Escotista',
            'sigla' => 'CPE',
            'versao' => 1,
            'tipo_curso_id' => 1,
            'linha_formacao_id' => 2,
            'ramo_id' => null,
        ]);
       
    }

}


class CursoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('curso')->delete();

        Curso::create([
            'grade_id' => 1,
            'criador_id' => 1,
        ]);
       
    }

}
