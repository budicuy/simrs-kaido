<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPerawatFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-perawat-from-a-p-i';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sync Perawat from API');
        $url = 'https://ti054a02.agussbn.my.id/api/perawats';
        $token = '5|OXbCPoiKD7g6xuOvMaBwEZnrA6IecVi7rEiuM6pd37de8074';
        $response = \Illuminate\Support\Facades\Http::withToken($token)->get($url);
        if ($response->successful()) {
            $perawats = $response->json();

            foreach ($perawats as $perawat) {
                \Illuminate\Support\Facades\DB::table('perawats')->updateOrInsert(
                    ['id' => $perawat['id']],
                    $perawat
                );
            }

            $this->info('✅ Data perawat berhasil disinkronisasi.');
        } else {
            $this->error('❌ Gagal mengambil data dari API. Status: ' . $response->status());
        }
    }
}
