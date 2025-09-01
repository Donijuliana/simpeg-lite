@extends('layout')

@section('content')
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: bold;">📊 Dashboard CENTRA ABIYOSO</h2>
        <p>Sistem Informasi Manajemen Kepegawaian Versi Ringan</p>
    </div>

    {{-- STATISTIK KARTU --}}
    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-bottom: 40px;">
        <div style="flex: 1; min-width: 250px; background: #3f8c9c; padding: 20px; border-radius: 12px; color: white;">
            <h4 style="margin-bottom: 10px;">👥 Total Pegawai Aktif</h4>
            <p style="font-size: 36px; font-weight: bold;">{{ $jumlahPegawai }}</p>
        </div>
        <div style="flex: 1; min-width: 250px; background: #607d8b; padding: 20px; border-radius: 12px; color: white;">
            <h4 style="margin-bottom: 10px;">🧳 Pegawai Sedang Cuti</h4>
            <p style="font-size: 36px; font-weight: bold;">{{ $jumlahCuti }}</p>
        </div>
        <div style="flex: 1; min-width: 250px; background: #3f8c9c; padding: 20px; border-radius: 12px; color: white;">
            <h4 style="margin-bottom: 10px;">📁 Pegawai Pensiun</h4>
            <p style="font-size: 36px; font-weight: bold;">{{ $jumlahPensiun }}</p>
        </div>
    </div>

    {{-- GRAFIK PELATIHAN --}}
    <div style="background:#607d8b; ; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h4 style="text-align: center; margin-bottom: 20px;">📅 Grafik Jumlah Pelatihan per Bulan</h4>
        <canvas id="pelatihanChart" height="100"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pelatihanChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($pelatihanBulanan->pluck('bulan')->map(fn($b) => date('F', mktime(0,0,0,$b,1)))) !!},
               datasets: [{
    label: 'Jumlah Pelatihan',
    backgroundColor: '#61fa66ff',
    data: {!! json_encode($pelatihanBulanan->pluck('total')) !!},
    barPercentage: 0.4,
    categoryPercentage: 0.8
}]

            },
            options: {
    responsive: true,
    plugins: {
        legend: {
            display: false
        },
        tooltip: {
            callbacks: {
                label: function(context) {
                    return `Jumlah: ${context.raw}`;
                }
            }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                precision: 0,
                color: '#ffffff' // <- warna angka di sumbu Y
            }
        },
        x: {
            ticks: {
                color: '#ffffff' // <- warna label bulan di sumbu X
            }
        }
    }
}

        });
    </script>
@endsection
