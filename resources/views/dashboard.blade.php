<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard – Gestão de Salas</title>

    <style>
        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background: #f1f5f9;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #1f2937;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 10px;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 8px;
            gap: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        /* TOPBAR */
        .topbar {
            position: fixed;
            top: 0;
            left: 260px; /* alinha ao lado da sidebar */
            right: 0;
             height: 60px;
            background: #1e293b;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 20px;
            color: white;
            gap: 20px;
            z-index: 10;
}


        /* CONTEÚDO */
        .content {
            padding: 90px 30px 30px;
            max-width: 1100px;
            margin-left: 340px;   /* empurra mais para a direita */
            margin-right: auto;
}




        /* CARDS ESTATÍSTICAS */
        .stats {
            display: flex;
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            width: 260px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .stat-title {
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            margin-top: 5px;
        }

        /* BLOCOS */
        .bloco-title {
            font-size: 18px;
            font-weight: 700;
            margin: 25px 0 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* CARDS DE SALA */
        .sala-card {
            background: white;
            border-radius: 10px;
            padding: 12px;
            width: 180px;
            border: 2px solid #d1d5db;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .sala-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .codigo {
            font-size: 16px;
            font-weight: 700;
        }

        .cap-info {
            font-size: 13px;
            color: #475569;
        }

        .recursos {
            font-size: 12px;
            color: #475569;
            margin-top: 5px;
        }

        /* STATUS COLORS */
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            float: right;
        }

        .verde { background: #22c55e; }
        .amarelo { background: #eab308; }
        .vermelho { background: #ef4444; }


        .btn-nova-reserva {
    background-color: #16a34a; /* verde */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(22, 163, 74, 0.5);
    transition: background-color 0.3s ease;
}

.btn-nova-reserva:hover {
    background-color: #15803d; /* verde escuro no hover */
}

.btn-agenda {
    background-color: #2563eb; /* azul */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(37, 99, 235, 0.5);
    transition: background-color 0.3s ease;
}

.btn-agenda:hover {
    background-color: #1d4ed8; /* azul escuro no hover */
}

.actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: -20px;
    margin-bottom: 30px;
    padding-right: 10px;
}
    


    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>🏫 UNC Mafra</h2>

        <a href="#">➕ Nova Sala</a>
        <a href="#">🔍 Buscar</a>
        <a href="#">🗺️ Mapa</a>
        <a href="#">⭐ Prioridades</a>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        Início
    </div>

    <!-- Conteúdo -->
    <div class="content">

       <!-- Estatísticas -->
<div class="stats">
    <div class="stat-card">
        <div class="stat-title">Total de Salas</div>
        <div class="stat-number">{{ $totalSalas }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Ocupadas Agora</div>
        <div class="stat-number" style="color:#ef4444;">
            {{ $ocupadasAgora }}
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Disponíveis</div>
        <div class="stat-number" style="color:#22c55e;">
            {{ $disponiveis }}
        </div>
    </div>
</div>

<!-- Botões alinhados à direita -->
<div class="actions">
    <button class="btn-nova-reserva">+ Nova Reserva</button>
    <button class="btn-agenda">Agenda</button>
</div>


        <!-- Listagem por bloco -->
        @foreach($blocos as $bloco)

            <div class="bloco-title">📌 Bloco {{ $bloco->nome }} – {{ $bloco->descricao }}</div>

            <div class="sala-container">
                @foreach($bloco->salas as $sala)

                    @php
                        $cor = [
                            'disponivel' => 'verde',
                            'ocupada' => 'vermelho',
                            'manutencao' => 'amarelo',
                        ][$sala->status];
                    @endphp

                    <div class="sala-card">
                        <div class="codigo">
                            {{ $sala->codigo }}
                            <div class="status-dot {{ $cor }}"></div>
                        </div>

                        <div class="cap-info">Cap: {{ $sala->capacidade }}</div>

                        <div class="recursos">
                            @foreach(json_decode($sala->recursos ?? '[]') as $r)
                                • {{ $r }} <br>
                            @endforeach
                        </div>
                    </div>

                @endforeach
            </div>

        @endforeach
    </div>

</body>
</html>
