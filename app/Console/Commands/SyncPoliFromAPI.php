<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPoliFromAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-poli-from-a-p-i';

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
        $this->info('Sync Poli from API');
        $url = 'https://ti054a02.agussbn.my.id/api/polis';
        $token= '5|OXbCPoiKD7g6xuOvMaBwEZnrA6IecVi7rEiuM6pd37de8074';
        $response = \Illuminate\Support\Facades\Http::withToken($token)->get($url);
        if ($response->successful()) {
            $polis = $response->json();
            foreach ($polis as $poli) {
                \Illuminate\Support\Facades\DB::table('polis')->updateOrInsert(
                    ['id' => $poli['id']],
                    $poli
                );
            }
            $this->info('✅ Data poli berhasil disinkronisasi.');
        } else {
            $this->error('❌ Gagal mengambil data dari API. Status: ' . $response->status());
        }
    }
}
