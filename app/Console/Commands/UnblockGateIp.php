<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GateLockoutService;

class UnblockGateIp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gate:unblock {ip? : Alamat IP yang ingin dibuka pemblokirannya} {--all : Buka pemblokiran seluruh alamat IP}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buka pemblokiran permanen alamat IP dari gerbang keamanan login admin';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $ip = $this->argument('ip');
        $all = $this->option('all');

        if ($all || (!$ip && $this->confirm('Apakah Anda ingin membuka pemblokiran untuk SEMUA alamat IP yang diblokir?', true))) {
            GateLockoutService::unblock();
            $this->info('Seluruh pemblokiran alamat IP pada gerbang keamanan berhasil dibersihkan.');
            return Command::SUCCESS;
        }

        if ($ip) {
            GateLockoutService::unblock($ip);
            $this->info("Pemblokiran untuk alamat IP [{$ip}] berhasil dibuka.");
            return Command::SUCCESS;
        }

        $this->warn('Tidak ada alamat IP yang ditentukan. Gunakan: php artisan gate:unblock <ip> atau --all');
        return Command::FAILURE;
    }
}

