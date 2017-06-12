<?php

use Illuminate\Database\Seeder;
use App\Ramo;
use App\LinhaFormacao;
use App\User;
use App\Associado;
use App\UEL;
use App\Grade;
use App\Modulo;
use App\GradeModulo;
use App\TipoCurso;
use App\Curso;
use App\Local;
use App\Distrito;

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

        $this->call('ModuloTableSeeder');
        $this->command->info('Modulo table seeded!');

        $this->call('GradeModuloTableSeeder');
        $this->command->info('GradeModulo table seeded!');

        $this->call('DistritoTableSeeder');
        $this->command->info('Distrito table seeded!');

        $this->call('LocalTableSeeder');
        $this->command->info('Local table seeded!');

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

class ModuloTableSeeder extends Seeder {

    public function run()
    {
        DB::table('modulo')->delete();

        // 1
        Modulo::create([
            'nome' => 'Recepção',
            'sigla' => 'Rec',
            'didatico' => false,
            'carga_horaria_min' => 30,
            'versao' => 1,
        ]);

        // 2
        Modulo::create([
            'nome' => 'Intervalo',
            'sigla' => 'Int',
            'didatico' => false,
            'carga_horaria_min' => 15,
            'versao' => 1,
        ]);

        // 3
        Modulo::create([
            'nome' => 'Refeição',
            'sigla' => 'Ref',
            'didatico' => false,
            'carga_horaria_min' => 15,
            'versao' => 1,
        ]);

        // 4
        Modulo::create([
            'nome' => 'Abertura',
            'sigla' => 'Abe',
            'didatico' => false,
            'carga_horaria_min' => 30,
            'versao' => 1,
        ]);

        // 5
        Modulo::create([
            'nome' => 'Encerramento',
            'sigla' => 'Rec',
            'didatico' => false,
            'carga_horaria_min' => 30,
            'versao' => 1,
        ]);

        // 6
        Modulo::create([
            'nome' => 'Modulo A',
            'sigla' => 'MA',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 7
        Modulo::create([
            'nome' => 'Modulo B',
            'sigla' => 'MB',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 8
        Modulo::create([
            'nome' => 'Modulo C',
            'sigla' => 'MC',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 9
        Modulo::create([
            'nome' => 'Modulo D',
            'sigla' => 'MD',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 10
        Modulo::create([
            'nome' => 'Modulo E',
            'sigla' => 'MA',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 11
        Modulo::create([
            'nome' => 'Modulo F',
            'sigla' => 'MB',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 12
        Modulo::create([
            'nome' => 'Modulo G',
            'sigla' => 'MC',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);

        // 13
        Modulo::create([
            'nome' => 'Modulo H',
            'sigla' => 'MD',
            'didatico' => true,
            'carga_horaria_min' => 120,
            'versao' => 1,
        ]);
       
    }

}



class GradeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('grade')->delete();

        Grade::create([
            'nome' => 'Preliminar Escotista',
            'sigla' => 'CPE',
            'qualificacao_diretor' => 'CF1',           
            'tipo_curso_id' => 1,
            'linha_formacao_id' => 2,
            'ramo_id' => null,
            'versao' => 1,
        ]);
       
    }

}


class DistritoTableSeeder extends Seeder {

    public function run()
    {
        DB::table('distrito')->delete();

        Distrito::create([
            'nome' => '01o. Distrito Escoteiro X',
            'sigla' => '1DESP',
            'regiao' => 'SP',
            'numeral' => 1,           
           'ativo' => true,
        ]);
       

       Distrito::create([
            'nome' => '02o. Distrito Escoteiro Z',
            'sigla' => '2DESP',
            'regiao' => 'SP',
            'numeral' => 2,           
            'ativo' => true,
        ]);
    }

}

class GradeModuloTableSeeder extends Seeder {

    public function run()
    {
        DB::table('grade_modulo')->delete();

        GradeModulo::create(['grade_id' => 1,'modulo_id' => 1, 'periodo' => 1, 'ordem' => 1]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 4, 'periodo' => 1, 'ordem' => 2]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 6, 'periodo' => 1, 'ordem' => 3]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 2, 'periodo' => 1, 'ordem' => 4]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 7, 'periodo' => 1, 'ordem' => 5]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 3, 'periodo' => 1, 'ordem' => 6]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 8, 'periodo' => 1, 'ordem' => 7]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 2, 'periodo' => 1, 'ordem' => 8]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 9, 'periodo' => 1, 'ordem' => 9]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 5, 'periodo' => 1, 'ordem' => 10]);


        GradeModulo::create(['grade_id' => 1,'modulo_id' => 1,  'periodo' => 2, 'ordem' => 1]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 4,  'periodo' => 2, 'ordem' => 2]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 10, 'periodo' => 2, 'ordem' => 3]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 2,  'periodo' => 2, 'ordem' => 4]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 11, 'periodo' => 2, 'ordem' => 5]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 3,  'periodo' => 2, 'ordem' => 6]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 12, 'periodo' => 2, 'ordem' => 7]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 2,  'periodo' => 2, 'ordem' => 8]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 13, 'periodo' => 2, 'ordem' => 9]);
        GradeModulo::create(['grade_id' => 1,'modulo_id' => 5,  'periodo' => 2, 'ordem' => 10]);       
    }

}

class LocalTableSeeder extends Seeder {

    public function run()
    {
        DB::table('local')->delete();

        Local::create([
            'nome' => 'Centro Escoteiro Jaraguá 1',
            'sigla' => 'CEJ1',
            'descricao' => 'xxxx',
            'capacidade_pessoas' => 24,
            'permite_pernoite_acampado' => false,
            'permite_pernoite_acantonado' => true,
            'endereco' => 'Rua Guarujá, 1',
            'contato' => 'Prefeito X (11) 99999-111111 x@escoiteirossp.org.br',
            'url_maps' => null,
        ]);
           
        Local::create([
            'nome' => 'Centro Escoteiro Jaraguá 2',
            'sigla' => 'CEJ2',
            'descricao' => 'xxxx',
            'capacidade_pessoas' => 32,
            'permite_pernoite_acampado' => true,
            'permite_pernoite_acantonado' => false,
            'endereco' => 'Rua Guarujá, 1',
            'contato' => 'Prefeito X (11) 99999-111111 x@escoiteirossp.org.br',
            'url_maps' => null,
        ]);

        Local::create([
            'nome' => 'Centro Escoteiro FLONA',
            'sigla' => 'CEFL',
            'descricao' => 'xxxx',
            'capacidade_pessoas' => 24,
            'permite_pernoite_acampado' => true,
            'permite_pernoite_acantonado' => false,
            'endereco' => 'Rua Guarujá, 1',
            'contato' => 'Prefeito X (11) 99999-111111 x@escoiteirossp.org.br',
            'url_maps' => null,
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
