@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="main-content">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Selamat Datang</h3>
                        <img src="foto/logo.png" alt="" style="max-width: 100%;">
                        <h3 class="text-center">Silahkan Konsultasi</h3>
                        <h3 class="text-center">Keperluan Anda</h3>
                        <p class="text-center">Konsultasi online</p>
                        <p class="text-center"><i class="fab fa-whatsapp"></i> <a
                                href="https://api.whatsapp.com/send?phone=628883662780">08883662780</a></p>
                        <p class="text-center"><i class="fab fa-instagram"></i> <a
                                href="https://www.instagram.com/rizqinurandiputra?igsh=d3RsbjVjdHRjOXg=">@rizqinurandiputra</a>
                        </p>
                    </div>
                </div>
            </div>
            @if (auth()->user()->role == 'admin')
                <canvas id="myChart" width="600" height="400"></canvas>
            @endif
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ambil data dari controller menggunakan AJAX
        fetch('/data-perbulan')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                createChart(data);
                console.log('Data:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        // Fungsi untuk membuat chart dengan data yang diperoleh dari controller
        function createChart(data) {
            const months = Object.keys(data);
            const values = Object.values(data);

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Jumlah',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
@endsection
