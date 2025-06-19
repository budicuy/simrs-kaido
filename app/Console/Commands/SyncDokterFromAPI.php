<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class SyncDokterFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-dokter-from-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi data dokter dari API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $url = 'https://ti054a02.agussbn.my.id/api/dokters';
        $token = '5|OXbCPoiKD7g6xuOvMaBwEZnrA6IecVi7rEiuM6pd37de8074';

        $response = Http::withToken($token)->get($url);

        if ($response->successful()) {
            $dokters = $response->json();

            foreach ($dokters as $dokter) {
                DB::table('dokters')->updateOrInsert(
                    ['id' => $dokter['id']],
                    $dokter
                );
            }

            $this->info('✅ Data dokter berhasil disinkronisasi.');
        } else {
            $this->error('❌ Gagal mengambil data dari API. Status: ' . $response->status());
        }
    }
}
