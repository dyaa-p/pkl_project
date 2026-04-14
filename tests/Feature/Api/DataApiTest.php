<?php

namespace Tests\Feature\Api;

use App\Models\KasMingguan;
use App\Models\Pembayaran;
use App\Models\Transaksikas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_returns_summary_data_for_authenticated_user(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        User::factory()->create();

        Transaksikas::create([
            'jenis' => 'pemasukkan',
            'jumlah' => 50000,
            'keterangan' => 'Kas masuk',
            'tanggal' => '2026-04-10',
        ]);

        Transaksikas::create([
            'jenis' => 'pengeluaran',
            'jumlah' => 15000,
            'keterangan' => 'Beli perlengkapan',
            'tanggal' => '2026-04-11',
        ]);

        Pembayaran::create([
            'user_id' => $user->id,
            'jumlah' => 20000,
            'tanggal' => '2026-04-12',
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/dashboard');

        $response->assertOk()
            ->assertJsonPath('status', true)
            ->assertJsonPath('data.total_user', 2)
            ->assertJsonPath('data.total_pemasukan', 50000)
            ->assertJsonPath('data.total_pengeluaran', 15000)
            ->assertJsonPath('data.total_pembayaran', 20000)
            ->assertJsonPath('data.saldo_kas', 55000);
    }

    public function test_pemasukan_endpoint_only_returns_pemasukkan_transactions(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        Transaksikas::create([
            'jenis' => 'pemasukkan',
            'jumlah' => 10000,
            'keterangan' => 'Kas masuk',
            'tanggal' => '2026-04-10',
        ]);

        Transaksikas::create([
            'jenis' => 'pengeluaran',
            'jumlah' => 5000,
            'keterangan' => 'Keluar',
            'tanggal' => '2026-04-11',
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/pemasukan');

        $response->assertOk()
            ->assertJsonPath('status', true)
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.jenis', 'pemasukkan');
    }

    public function test_user_dashboard_returns_authenticated_user_summary(): void
    {
        Carbon::setTestNow('2026-04-13 09:00:00');

        $user = User::factory()->create([
            'role' => 'user',
        ]);

        Pembayaran::create([
            'user_id' => $user->id,
            'jumlah' => 25000,
            'tanggal' => '2026-04-05',
        ]);

        KasMingguan::create([
            'user_id' => $user->id,
            'status' => 'lunas',
            'minggu_ke' => 2,
            'bulan' => 4,
            'jumlah' => 10000,
            'tanggal_bayar' => '2026-04-13',
        ]);

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/user/dashboard');

        $response->assertOk()
            ->assertJsonPath('status', true)
            ->assertJsonPath('data.user.id', $user->id)
            ->assertJsonPath('data.user.role', 'user')
            ->assertJsonPath('data.ringkasan.total_pembayaran', 25000)
            ->assertJsonPath('data.ringkasan.bulan', 4)
            ->assertJsonPath('data.ringkasan.minggu_ke', 2)
            ->assertJsonPath('data.ringkasan.status_kas_minggu_ini', 'lunas')
            ->assertJsonPath('data.ringkasan.jumlah_kas_minggu_ini', 10000)
            ->assertJsonCount(1, 'data.kas_bulan_ini');

        Carbon::setTestNow();
    }
}
