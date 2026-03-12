<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PharmaLink {{ $type }} Report</title>
    <link href="" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Carlito', 'Calibri', 'Segoe UI', sans-serif;
            background: #ffffff;
            color: #1a1d24;
            font-size: 12px;
            line-height: 1.5;
            padding: 40px 48px 56px;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Header ── */
        .report-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding-bottom: 22px;
            border-bottom: 2px solid #0f1115;
            margin-bottom: 28px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            width: 34px; height: 34px;
            border-radius: 8px;
            background: #10b981;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .brand-icon svg { width: 17px; height: 17px; }

        .brand-name {
            font-family: 'Instrument Serif', serif;
            font-size: 20px;
            letter-spacing: -0.02em;
            color: #0f1115;
            line-height: 1;
        }

        .brand-name em { font-style: normal; color: #10b981; }

        .brand-sub {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-top: 3px;
        }

        .header-right { text-align: right; }

        .report-type {
            font-family: 'Instrument Serif', serif;
            font-size: 22px;
            letter-spacing: -0.02em;
            color: #0f1115;
            line-height: 1;
        }

        .report-range {
            font-size: 11px;
            color: #6b7280;
            margin-top: 5px;
        }

        .generated-on {
            font-size: 10px;
            color: #9ca3af;
            margin-top: 3px;
        }

        /* ── Summary cards ── */
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 14px;
            margin-bottom: 30px;
        }

        .summary-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px 18px;
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
        }

        .summary-card.green::before { background: #10b981; }
        .summary-card.slate::before { background: #334155; }
        .summary-card.blue::before  { background: #3b82f6; }

        .sc-label {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 7px;
        }

        .sc-val {
            font-family: 'Instrument Serif', serif;
            font-size: 24px;
            letter-spacing: -0.03em;
            color: #0f1115;
            line-height: 1;
        }

        .sc-val.green { color: #10b981; }

        .sc-sub {
            font-size: 10px;
            color: #9ca3af;
            margin-top: 5px;
        }

        /* ── Section label ── */
        .section-label {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: #9ca3af;
            margin-bottom: 10px;
        }

        /* ── Table ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .data-table thead tr {
            background: #0f1115;
        }

        .data-table th {
            padding: 10px 14px;
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9ca3af;
            text-align: left;
            white-space: nowrap;
        }

        .data-table th:last-child { text-align: right; }

        .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background 0.1s;
        }

        .data-table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table td {
            padding: 10px 14px;
            font-size: 11.5px;
            color: #374151;
            vertical-align: middle;
        }

        .td-receipt {
            font-family: 'Instrument Serif', serif;
            font-size: 13px;
            color: #0f1115;
            font-weight: 700;
        }

        .td-date { color: #6b7280; }

        .td-customer { font-weight: 600; color: #1f2937; }

        .td-phone { color: #6b7280; font-size: 11px; }

        .td-email { color: #6b7280; font-size: 11px; }

        .td-amount {
            font-family: 'Instrument Serif', serif;
            font-size: 13px;
            color: #0f1115;
            font-weight: 700;
            text-align: right;
            white-space: nowrap;
        }

        /* ── Grand total row ── */
        .grand-total-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            padding: 14px 14px;
            background: #0f1115;
            border-radius: 8px;
            margin-bottom: 32px;
        }

        .gt-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #9ca3af;
        }

        .gt-val {
            font-family: 'Instrument Serif', serif;
            font-size: 20px;
            letter-spacing: -0.02em;
            color: #10b981;
        }

        /* ── Footer ── */
        .report-footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-brand {
            font-family: 'Instrument Serif', serif;
            font-size: 13px;
            color: #9ca3af;
            letter-spacing: -0.01em;
        }

        .footer-brand em { font-style: normal; color: #10b981; }

        .footer-note {
            font-size: 10px;
            color: #d1d5db;
        }

        /* ── Print ── */
        @media print {
            body { padding: 24px 32px; }
            .summary-card { break-inside: avoid; }
            .data-table { break-inside: auto; }
            .data-table tr { break-inside: avoid; }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="report-header">
        <div>
            <div class="brand">
                <div class="brand-icon">
                    <svg width="15" height="15" fill="none" stroke="#000" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                </div>
                <div>
                    <div class="brand-name">Pharma<em>Link</em></div>
                    <div class="brand-sub">Admin Report</div>
                </div>
            </div>
        </div>
        <div class="header-right">
            <div class="report-type">{{ $type }} Report</div>
            <div class="report-range">{{ $date_range }}</div>
            <div class="generated-on">Generated: {{ now()->format('d M Y · h:i A') }}</div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="summary-grid">
        <div class="summary-card green">
            <div class="sc-label">Total Revenue</div>
            <div class="sc-val green">Rs. {{ number_format($totalSales, 0) }}</div>
            <div class="sc-sub">Net earnings this period</div>
        </div>
        <div class="summary-card slate">
            <div class="sc-label">Total Orders</div>
            <div class="sc-val">{{ $totalOrders }}</div>
            <div class="sc-sub">Bills generated</div>
        </div>
        <div class="summary-card blue">
            <div class="sc-label">Avg. Order Value</div>
            <div class="sc-val">Rs. {{ $totalOrders > 0 ? number_format($totalSales / $totalOrders, 0) : '0' }}</div>
            <div class="sc-sub">Per transaction</div>
        </div>
    </div>

    <!-- Table -->
    <div class="section-label">Transaction Records</div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Receipt ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receipts as $receipt)
            <tr>
                <td class="td-receipt">{{ $receipt->receipt_handle ?? $receipt->id }}</td>
                <td class="td-date">{{ $receipt->created_at->format('d M Y') }}</td>
                <td class="td-customer">{{ $receipt->customer_name ?? optional($receipt->customer)->name ?? 'Walk-in' }}</td>
                <td class="td-phone">{{ $receipt->customer_phone ?: (optional($receipt->customer)->phone ?: '—') }}</td>
                <td class="td-email">{{ $receipt->customer_email ?: (optional($receipt->customer)->email ?: '—') }}</td>
                <td class="td-amount">Rs. {{ number_format($receipt->total_amount, 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Grand Total -->
    <div class="grand-total-row">
        <span class="gt-label">Grand Total</span>
        <span class="gt-val">Rs. {{ number_format($totalSales, 2) }}</span>
    </div>

    <!-- Footer -->
    <div class="report-footer">
        <div class="footer-brand">Pharma<em>Link</em> Digital</div>
        <div class="footer-note">This is a computer-generated report. No signature required.</div>
    </div>

</body>
</html>