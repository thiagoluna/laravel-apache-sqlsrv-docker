<?php

use Illuminate\Database\Seeder;
use App\Models\Equipe;

class EquipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nomes = ['Gabinete', 'Almoxarifado/Patrimônio', 'Compras e Licitação', 'Contratos',
            'Engenharia', 'Segurança Institucional', 'Serviços Gerais'];

        foreach ($nomes as $nome) {
            $equipe = new Equipe;
            $equipe->nome = $nome;
            $equipe->save();
        }
    }
}
