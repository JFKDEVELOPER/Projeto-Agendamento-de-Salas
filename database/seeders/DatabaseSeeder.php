<?php

namespace Database\Seeders;

use App\Models\Bloco;
use App\Models\Sala;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Criar um usuário admin (opcional)
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@uncmafra.edu',
            'password' => bcrypt('password123'),
        ]);

        // Criar blocos
        $blocos = [
            ['nome' => 'A', 'descricao' => 'Bloco A - Salas de Aula'],
            ['nome' => 'B', 'descricao' => 'Bloco B - Laboratórios'],
            ['nome' => 'C', 'descricao' => 'Bloco C - Auditórios'],
        ];
        
        foreach ($blocos as $bloco) {
            Bloco::create($bloco);
        }
        
        // Criar salas (exemplo do seu layout)
        $salas = [
            // Bloco A
            [
                'bloco_id' => 1,
                'codigo' => 'A101',
                'nome' => 'Sala A101',
                'capacidade' => 40,
                'tipo' => 'aula',
                'recursos' => json_encode(['datashow']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 1,
                'codigo' => 'A102',
                'nome' => 'Laboratório de Informática A102',
                'capacidade' => 35,
                'tipo' => 'laboratorio',
                'recursos' => json_encode(['lab_info', 'computadores']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 1,
                'codigo' => 'A103',
                'nome' => 'Sala A103',
                'capacidade' => 45,
                'tipo' => 'aula',
                'recursos' => json_encode(['quadro']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 1,
                'codigo' => 'A104',
                'nome' => 'Sala A104',
                'capacidade' => 30,
                'tipo' => 'aula',
                'recursos' => json_encode(['manutencao']),
                'status' => 'manutencao'
            ],
            [
                'bloco_id' => 1,
                'codigo' => 'A105',
                'nome' => 'Sala A105',
                'capacidade' => 50,
                'tipo' => 'aula',
                'recursos' => json_encode(['datashow']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 1,
                'codigo' => 'A106',
                'nome' => 'Laboratório A106',
                'capacidade' => 25,
                'tipo' => 'laboratorio',
                'recursos' => json_encode(['lab']),
                'status' => 'disponivel'
            ],
            // Bloco B
            [
                'bloco_id' => 2,
                'codigo' => 'B201',
                'nome' => 'Laboratório de Informática B201',
                'capacidade' => 20,
                'tipo' => 'laboratorio',
                'recursos' => json_encode(['30_pcs', 'datashow']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 2,
                'codigo' => 'B202',
                'nome' => 'Laboratório de Biologia',
                'capacidade' => 15,
                'tipo' => 'laboratorio',
                'recursos' => json_encode(['microscopios', 'bancada']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 2,
                'codigo' => 'B203',
                'nome' => 'Laboratório de Química',
                'capacidade' => 18,
                'tipo' => 'laboratorio',
                'recursos' => json_encode(['bancada_quimica', 'exaustor']),
                'status' => 'disponivel'
            ],
            // Bloco C
            [
                'bloco_id' => 3,
                'codigo' => 'C301',
                'nome' => 'Auditório Principal',
                'capacidade' => 200,
                'tipo' => 'auditorio',
                'recursos' => json_encode(['projetor', 'som', 'palco', 'ar_condicionado']),
                'status' => 'disponivel'
            ],
            [
                'bloco_id' => 3,
                'codigo' => 'C302',
                'nome' => 'Mini Auditório',
                'capacidade' => 150,
                'tipo' => 'auditorio',
                'recursos' => json_encode(['projetor', 'tela', 'ar_condicionado']),
                'status' => 'disponivel'
            ],
        ];
        
        foreach ($salas as $sala) {
            Sala::create($sala);
        }
        
        $this->command->info('✅ Banco de dados populado com sucesso!');
        $this->command->info('📊 Total de blocos: ' . Bloco::count());
        $this->command->info('🚪 Total de salas: ' . Sala::count());
    }
}