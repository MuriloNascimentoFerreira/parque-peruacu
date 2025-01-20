<?php

namespace App\Console\Commands;

use App\Models\Visita;
use Illuminate\Console\Command;

class CleanForgottenVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visitas:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Excluem as visitas que não possuem relacionamento com agendamento depois de 10 minutos de criação.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando limpeza de visitas...');
        info('Limpeza de visitas iniciada...');

        $visitasDeletadas = Visita::whereNull('agendamento_id')->where('created_at', '<=', now()->subMinutes(10))->delete();

        $this->info('Visitas deletadas: ' . $visitasDeletadas);
        info('Visitas deletadas: ' . $visitasDeletadas);
        $this->info('Limpeza de visitas concluida!');
        info('Limpeza de visitas concluida!');

        return Command::SUCCESS;
    }
}
