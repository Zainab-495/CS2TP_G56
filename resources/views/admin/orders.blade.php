<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Orders – Admin – Skyrose Atelier</title>
    @include('partials.head')
    <style>
        .AdminPage { max-width: 1300px; margin: 80px auto 60px; padding: 0 24px 60px; }
        .AdminPage h1 { font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
        .AdminSubnav { display: flex; gap: 10px; margin-bottom: 32px; flex-wrap: wrap; }
        .AdminSubnav a { display: inline-block; font-size: 14px; font-weight: 600; text-decoration: none; padding: 8px 20px; border-radius: 4px; border: 2px solid #c8c389; color: #c8c389; transition: all 0.2s; }
        .AdminSubnav a:hover, .AdminSubnav a.active { background: #c8c389; color: #fff; }

        /* Filters */
        .filter-bar { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 24px; align-items: flex-end; }
        .filter-bar input, .filter-bar select { padding: 9px 14px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; color: #333; background: #fff; }
        .filter-bar input { min-width: 240px; }
        .filter-btn { padding: 9px 20px; background: #c8c389; color: #fff; border: none; border-radius: 4px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.2s; }
        .filter-btn:hover { background: #b5b070; }
        .filter-clear { padding: 9px 16px; background: #f5f0e8; color: #555; border: 1px solid #e8e0d0; border-radius: 4px; font-size: 14px; text-decoration: none; }

        /* Table */
        .orders-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #e8e0d0; }
        .orders-table th { background: #1a1a1a; color: #fff; padding: 13px 16px; text-align: left; font-size: 12px; text-transform: uppercase; letter-spacing: 0.6px; white-space: nowrap; }
        .orders-table td { padding: 14px 16px; border-bottom: 1px solid #f5f0e8; font-size: 14px; color: #333; vertical-align: middle; }
        .orders-table tr:last-child td { border-bottom: none; }
        .orders-table tr:hover td { background: #fdfaf5; }

        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: capitalize; }
        .status-pending    { background: #fff3cd; color: #856404; }
        .status-processing { background: #cfe2ff; color: #084298; }
        .status-shipped    { background: #d1ecf1; color: #0c5460; }
        .status-completed  { background: #d4edda; color: #155724; }
        .status-cancelled  { background: #f8d7da; color: #721c24; }
        .status-refunded   { background: #e2d9f3; color: #432874; }

        .status-form { display: flex; gap: 8px; align-items: center; }
        .status-select { padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: #fff; }
        .save-btn { padding: 6px 14px; background: #c8c389; color: #fff; border: none; border-radius: 4px; font-size: 13px; font-weight: 600; cursor: pointer; white-space: nowrap; transition: background 0.2s; }
        .save-btn:hover { background: #b5b070; }

        .view-link { color: #111; font-weight: 700; text-decoration: none; font-size: 13px; }
        .view-link:hover { text-decoration: underline; }

        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 20px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .summary { font-size: 14px; color: #888; margin-bottom: 12px; }

        .pagination-wrap { margin-top: 28px; display: flex; justify-content: center; }
        .pagination-wrap nav { display: flex; gap: 6px; }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <div class="PageContent">
            @include('partials.nav')

            <div class="AdminPage">
                <h1>Customer Orders</h1>
                <div class="AdminSubnav">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.orders') }}" class="active">Customer Orders</a>
                </div>

                @if(session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                {{-- Filters --}}
                <form method="GET" action="{{ route('admin.orders') }}" class="filter-bar">
                    <input type="text" name="search" placeholder="Search by customer name, email or order #"
                           value="{{ request('search') }}">
                    <select name="status">
                        <option value="">All Statuses</option>
                        @foreach($statuses as $s)
                            <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="filter-btn">Filter</button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.orders') }}" class="filter-clear">Clear</a>
                    @endif
                </form>

                <p class="summary">Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }} orders</p>

                @if($orders->isEmpty())
                    <p style="text-align:center;color:#aaa;padding:60px 0;">No orders found.</p>
                @else
                    <div style="overflow-x:auto;">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th style="text-align:center;">Items</th>
                                    <th style="text-align:right;">Total</th>
                                    <th>Status</th>
                                    <th>Update Status</th>
                                    <th style="text-align:center;">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td style="font-weight:700;">#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td style="font-weight:600;">{{ $order->user->name ?? 'Unknown' }}</td>
                                    <td style="font-size:13px;color:#888;">{{ $order->user->email ?? '—' }}</td>
                                    <td style="text-align:center;">{{ $order->items->count() }}</td>
                                    <td style="text-align:right;font-weight:700;">&pound;{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        @if($order->status === 'returned')
                                            <span style="margin-left:8px; padding:4px 12px; border-radius:20px; background:#ffb3b3; color:#a10000; font-size:12px; font-weight:700;">Return Requested</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method="POST"
                                              action="{{ route('admin.orders.updateStatus', $order->id) }}"
                                              class="status-form">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="status-select">
                                                @foreach($statuses as $s)
                                                    <option value="{{ $s }}" @selected($order->status === $s)>{{ ucfirst($s) }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="save-btn">Save</button>
                                        </form>
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="{{ route('orders.show', $order->id) }}" class="view-link">View &rarr;</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrap">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>

        @include('partials.footer')
    </div>
</body>
</html>