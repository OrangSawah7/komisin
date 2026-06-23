@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('sidebar-menu')
    <a href="/admin/dashboard" class="nav-link active">
        <i class="bi bi-grid"></i> Dashboard
    </a>
    <a href="/admin/commissions" class="nav-link">
        <i class="bi bi-palette"></i> Kelola Komisi
    </a>
    <a href="/admin/orders" class="nav-link">
        <i class="bi bi-box"></i> Kelola Order
    </a>
    <a href="/admin/users" class="nav-link">
        <i class="bi bi-people"></i> Kelola User
    </a>
@endsection

@section('content')

    {{-- STAT CARDS --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4 anim-fadeup delay-1">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div style="font-size: 0.75rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Total User</div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--navy);">
                    {{ \App\Models\User::where('role', 'customer')->count() }}
                </div>
                <div style="font-size: 0.8rem; color: var(--blue-light); margin-top: 8px;">
                    Customer terdaftar
                </div>
            </div>
        </div>
        <div class="col-md-4 anim-fadeup delay-2">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-palette"></i>
                </div>
                <div style="font-size: 0.75rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Total Komisi</div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--navy);">
                    {{ \App\Models\Commission::count() }}
                </div>
                <div style="font-size: 0.8rem; color: var(--blue-light); margin-top: 8px;">
                    Listing aktif
                </div>
            </div>
        </div>
        <div class="col-md-4 anim-fadeup delay-3">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-box"></i>
                </div>
                <div style="font-size: 0.75rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Total Order</div>
                <div style="font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; color: var(--navy);">
                    {{ \App\Models\Order::count() }}
                </div>
                <div style="font-size: 0.8rem; color: var(--blue-light); margin-top: 8px;">
                    Semua order masuk
                </div>
            </div>
        </div>
    </div>

    {{-- CHARTS ROW --}}
    <div class="row g-4 mb-4">
        {{-- Order per bulan --}}
        <div class="col-md-8 anim-fadeup delay-2">
            <div class="form-card h-100">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                    <div>
                        <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Statistik</div>
                        <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0;">Order per Bulan</h6>
                    </div>
                    <div style="font-size: 0.8rem; color: var(--blue-light);">{{ date('Y') }}</div>
                </div>
                <canvas id="orderChart" height="100"></canvas>
            </div>
        </div>

        {{-- Status order --}}
        <div class="col-md-4 anim-fadeup delay-3">
            <div class="form-card h-100">
                <div style="margin-bottom: 24px;">
                    <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Breakdown</div>
                    <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0;">Status Order</h6>
                </div>
                <canvas id="statusChart" height="180"></canvas>
                <div style="margin-top: 20px; display: flex; flex-direction: column; gap: 8px;">
                    @php
                        $statusData = [
                            ['label' => 'Pending', 'value' => \App\Models\Order::where('status', 'pending')->count(), 'color' => '#FCD34D'],
                            ['label' => 'Menunggu Bayar', 'value' => \App\Models\Order::where('status', 'waiting_payment')->count(), 'color' => '#60A5FA'],
                            ['label' => 'In Progress', 'value' => \App\Models\Order::where('status', 'in_progress')->count(), 'color' => '#34D399'],
                            ['label' => 'Selesai', 'value' => \App\Models\Order::where('status', 'completed')->count(), 'color' => '#111844'],
                            ['label' => 'Ditolak', 'value' => \App\Models\Order::where('status', 'rejected')->count(), 'color' => '#F87171'],
                        ];
                    @endphp
                    @foreach($statusData as $s)
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 10px; height: 10px; border-radius: 50%; background: {{ $s['color'] }};"></div>
                                <span style="font-size: 0.8rem; color: var(--blue);">{{ $s['label'] }}</span>
                            </div>
                            <span style="font-size: 0.8rem; font-weight: 600; color: var(--navy);">{{ $s['value'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ORDER TERBARU --}}
    <div class="anim-fadeup delay-3">
        <div class="table-custom">
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--cream-dark); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 0.7rem; color: var(--blue-light); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Terbaru</div>
                    <h6 style="font-family: 'Playfair Display', serif; color: var(--navy); margin: 0;">Order Masuk</h6>
                </div>
                <a href="/admin/orders" style="font-size: 0.8rem; color: var(--blue); text-decoration: none;">
                    Lihat semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            @php $recentOrders = \App\Models\Order::with(['commission', 'customer'])->latest()->take(5)->get(); @endphp
            @if($recentOrders->isEmpty())
                <div style="padding: 40px; text-align: center;">
                    <i class="bi bi-inbox" style="font-size: 2rem; color: var(--blue-light); opacity: 0.4;"></i>
                    <p style="color: var(--blue-light); margin-top: 12px; font-size: 0.875rem;">Belum ada order masuk.</p>
                </div>
            @else
                <table style="width:100%; border-collapse: collapse;">
                    <thead>
                    <tr style="border-bottom: 1px solid var(--cream-dark);">
                        <th style="padding: 12px 20px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Customer</th>
                        <th style="padding: 12px 20px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Komisi</th>
                        <th style="padding: 12px 20px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Total</th>
                        <th style="padding: 12px 20px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Status</th>
                        <th style="padding: 12px 20px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: var(--blue-light);">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recentOrders as $order)
                        @php
                            $statusMap = [
                                'pending' => ['label' => 'Pending', 'class' => 'status-pending'],
                                'waiting_payment' => ['label' => 'Menunggu Bayar', 'class' => 'status-waiting'],
                                'in_progress' => ['label' => 'In Progress', 'class' => 'status-progress'],
                                'completed' => ['label' => 'Selesai', 'class' => 'status-completed'],
                                'rejected' => ['label' => 'Ditolak', 'class' => 'status-rejected'],
                                'cancelled' => ['label' => 'Dibatalkan', 'class' => 'status-cancelled'],
                            ];
                            $s = $statusMap[$order->status] ?? ['label' => $order->status, 'class' => 'status-pending'];
                        @endphp
                        <tr style="border-bottom: 1px solid var(--cream);">
                            <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--navy); font-weight: 500;">{{ $order->customer->name }}</td>
                            <td style="padding: 14px 20px; font-size: 0.875rem; color: var(--blue);">{{ $order->commission->title }}</td>
                            <td style="padding: 14px 20px; font-size: 0.875rem; font-weight: 600; color: var(--navy);">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td style="padding: 14px 20px;">
                                <span class="status-badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                            </td>
                            <td style="padding: 14px 20px;">
                                <a href="/admin/orders/{{ $order->id }}" class="btn-outline-navy" style="padding: 6px 14px; font-size: 0.8rem;">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- CHART JS --}}
    @php
        $orderChartData = collect(range(1, 12))->map(function($m) {
            return \App\Models\Order::whereMonth('created_at', $m)
                ->whereYear('created_at', date('Y'))
                ->count();
        })->values()->toArray();
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const orderData = @json($orderChartData);

        new Chart(document.getElementById('orderChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Order',
                    data: orderData,
                    borderColor: '#111844',
                    backgroundColor: 'rgba(17,24,68,0.06)',
                    borderWidth: 2,
                    pointBackgroundColor: '#111844',
                    pointRadius: 4,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#7288AE', font: { size: 11 } },
                        grid: { color: '#EAE0CF' }
                    },
                    x: {
                        ticks: { color: '#7288AE', font: { size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Menunggu Bayar', 'In Progress', 'Selesai', 'Ditolak'],
                datasets: [{
                    data: [
                        {{ \App\Models\Order::where('status', 'pending')->count() }},
                        {{ \App\Models\Order::where('status', 'waiting_payment')->count() }},
                        {{ \App\Models\Order::where('status', 'in_progress')->count() }},
                        {{ \App\Models\Order::where('status', 'completed')->count() }},
                        {{ \App\Models\Order::where('status', 'rejected')->count() }},
                    ],
                    backgroundColor: ['#FCD34D', '#60A5FA', '#34D399', '#111844', '#F87171'],
                    borderWidth: 0,
                }]
            },
            options: {
                responsive: true,
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });
    </script>

@endsection
