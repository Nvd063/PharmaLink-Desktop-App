<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .summary { margin: 20px 0; padding: 20px; background: #f9f9f9; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #111; color: white; padding: 10px; text-align: left; font-size: 12px; }
        td { padding: 10px; border-bottom: 1px solid #eee; font-size: 11px; }
        .total { text-align: right; font-weight: bold; font-size: 16px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>PharmaLink {{ $type }} Report</h1>
        <p>{{ $date_range }}</p>
    </div>

    <div class="summary">
        <p>Total Orders: <strong>{{ $totalOrders }}</strong></p>
        <p>Total Revenue: <strong>Rs. {{ number_format($totalSales, 0) }}</strong></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Receipt ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipts as $receipt)
                <tr>
                    <td>#{{ $receipt->id }}</td>
                    <td>{{ $receipt->created_at->format('d M, Y') }}</td>
                    <td>{{ $receipt->customer_name ?? 'N/A' }}</td>
                    <td>Rs. {{ number_format($receipt->total_amount, 0) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">Total: Rs. {{ number_format($totalSales, 2) }}</div>
</body>
</html>