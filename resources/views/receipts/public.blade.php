<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt {{ $receipt->receipt_handle }} — PharmaLink</title>
    <link href="" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg: #08090b;
            --surface: #111318;
            --surface2: #161921;
            --border: rgba(255, 255, 255, 0.07);
            --border2: rgba(255, 255, 255, 0.11);
            --text: #d4d8e2;
            --text2: #6b7280;
            --text3: #3d4451;
            --green: #10b981;
            --green-bg: rgba(16, 185, 129, 0.07);
            --green-bdr: rgba(16, 185, 129, 0.15);
        }

        html,
        body {
            min-height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'Instrument Sans', sans-serif;
            font-size: 13.5px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px 56px;
        }

        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 3px;
        }

        /* ── Card ── */
        .card {
            width: 100%;
            max-width: 430px;
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.55);
        }

        /* ── Top accent ── */
        .card-top {
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--green) 50%, transparent 100%);
        }

        /* ── Header ── */
        .card-header {
            padding: 24px 24px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .brand-mark {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-name {
            font-family: 'Instrument Serif', serif;
            font-size: 17px;
            color: #e8eaf0;
            letter-spacing: -0.02em;
        }

        .brand-name em {
            font-style: normal;
            color: var(--green);
        }

        .verified-pill {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
            font-weight: 600;
            color: var(--green);
            background: var(--green-bg);
            border: 1px solid var(--green-bdr);
            padding: 4px 11px;
            border-radius: 100px;
            letter-spacing: 0.04em;
        }

        .verified-pill svg {
            width: 11px;
            height: 11px;
            stroke-width: 2.5;
        }

        /* ── Meta row (receipt id + date) ── */
        .meta-row {
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid var(--border);
        }

        .meta-label {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 4px;
        }

        .meta-val {
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: #c8ccd6;
            letter-spacing: -0.01em;
        }

        /* ── Total ── */
        .total-block {
            margin: 20px;
            padding: 20px 24px;
            background: var(--green-bg);
            border: 1px solid var(--green-bdr);
            border-radius: 12px;
            text-align: center;
        }

        .total-eyebrow {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--green);
            margin-bottom: 6px;
        }

        .total-amount {
            font-family: 'Instrument Serif', serif;
            font-size: 38px;
            letter-spacing: -0.03em;
            color: #eaecf2;
            line-height: 1;
        }

        /* ── Items ── */
        .items-wrap {
            padding: 0 20px;
        }

        .items-thead {
            display: flex;
            justify-content: space-between;
            padding: 12px 0 8px;
            border-bottom: 1px solid var(--border);
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text3);
        }

        .item-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            gap: 12px;
        }

        .item-row:last-child {
            border-bottom: none;
        }

        .item-name {
            font-size: 13.5px;
            font-weight: 500;
            color: var(--text);
        }

        .item-sub {
            font-size: 11px;
            color: var(--text2);
            margin-top: 2px;
        }

        .item-total {
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: #c0c4ce;
            letter-spacing: -0.01em;
            white-space: nowrap;
            flex-shrink: 0;
            padding-top: 1px;
        }

        /* ── Divider ── */
        .dashed {
            border: none;
            border-top: 1px dashed rgba(255, 255, 255, 0.07);
            margin: 0 20px;
        }

        /* ── Grand total summary ── */
        .summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
        }

        .summary-label {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text2);
        }

        .summary-val {
            font-family: 'Instrument Serif', serif;
            font-size: 18px;
            color: var(--green);
            letter-spacing: -0.01em;
        }

        /* ── Customer ── */
        .customer-block {
            margin: 0 20px 20px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 14px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }

        .cust-label {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 4px;
        }

        .cust-val {
            font-size: 13px;
            font-weight: 500;
            color: #c0c4ce;
        }

        /* ── QR section ── */
        .qr-section {
            margin: 0 20px 20px;
            padding: 20px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .qr-box {
            background: #fff;
            border-radius: 8px;
            padding: 10px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-info {}

        .qr-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 4px;
        }

        .qr-sub {
            font-size: 11px;
            color: var(--text2);
            line-height: 1.5;
        }

        /* ── Action buttons ── */
        .actions {
            padding: 16px 20px 20px;
            display: flex;
            gap: 10px;
            border-top: 1px solid var(--border);
        }

        .btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 11px 16px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Instrument Sans', sans-serif;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.15s;
            letter-spacing: 0.03em;
        }

        .btn svg {
            width: 14px;
            height: 14px;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .btn-dark {
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border2);
        }

        .btn-dark:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        .btn-whatsapp {
            background: #25d366;
            color: #000;
        }

        .btn-whatsapp:hover {
            background: #22c45e;
        }

        /* ── Footer ── */
        .powered {
            margin-top: 24px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text3);
        }

        /* ── Print styles ── */
        @media print {
            body {
                background: #fff;
                padding: 0;
            }

            .card {
                box-shadow: none;
                border: 1px solid #ddd;
                max-width: 100%;
            }

            .actions {
                display: none;
            }

            .card-top {
                background: #10b981;
            }
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="card-top"></div>

        <!-- Header -->
        <div class="card-header">
            <div class="brand">
                <div class="brand-mark">
                    <svg width="15" height="15" fill="none" stroke="#000" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <div class="brand-name">Pharma<em>Link</em></div>
            </div>
            <div class="verified-pill">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Verified
            </div>
        </div>

        <!-- Receipt ID + Date -->
        <div class="meta-row">
            <div>
                <div class="meta-label">Receipt</div>
                <div class="meta-val">{{ $receipt->receipt_handle }}</div>
            </div>
            <div style="text-align:right;">
                <div class="meta-label">Date</div>
                <div class="meta-val">{{ $receipt->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <!-- Total -->
        <div class="total-block">
            <div class="total-eyebrow">Amount Paid</div>
            <div class="total-amount">Rs. {{ number_format($receipt->total_amount, 2) }}</div>
        </div>

        <!-- Items -->
        <div class="items-wrap">
            <div class="items-thead">
                <span>Item</span>
                <span>Total</span>
            </div>
            @foreach($receipt->items as $item)
                <div class="item-row">
                    <div>
                        <div class="item-name">{{ $item->product->name }}</div>
                        <div class="item-sub">{{ $item->quantity }} units &nbsp;·&nbsp; Rs.
                            {{ number_format($item->price_at_time, 2) }} each</div>
                    </div>
                    <div class="item-total">Rs. {{ number_format($item->quantity * $item->price_at_time, 2) }}</div>
                </div>
            @endforeach
        </div>

        <!-- Dashed divider -->
        <hr class="dashed" style="margin-top:4px;">

        <!-- Grand total row -->
        <div class="summary">
            <span class="summary-label">Grand Total</span>
            <span class="summary-val">Rs. {{ number_format($receipt->total_amount, 2) }}</span>
        </div>

        <!-- Customer -->
        <div class="customer-block">
            <div>
                <div class="cust-label">Customer</div>
                <div class="cust-val">{{ $receipt->customer->name ?? 'Walk-in Customer' }}</div>
            </div>
            <div style="text-align:right;">
                <div class="cust-label">Phone</div>
                <div class="cust-val">{{ $receipt->customer->phone ?? '—' }}</div>
            </div>
        </div>

        <!-- QR code -->
        <div class="qr-section">
            <div class="qr-box">
                {!! QrCode::size(72)->generate(Request::url()) !!}
            </div>
            <div class="qr-info">
                <div class="qr-title">Scan to verify receipt</div>
                <div class="qr-sub">
                    Computer-generated digital receipt.<br>
                    No signature required. Go paperless.
                </div>
                <div style="font-size:10.5px;color:var(--text3);margin-top:6px;">
                    {{ $receipt->created_at->format('d M Y · h:i A') }}
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="actions no-print">
            <button onclick="window.print()" class="btn btn-dark">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Download PDF
            </button>
            <a href="https://wa.me/?text=My PharmaLink Receipt: {{ urlencode(Request::url()) }}" target="_blank"
                class="btn btn-whatsapp">
                <svg fill="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px;">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                Share on WhatsApp
            </a>
        </div>
    </div>

    <p class="powered">Powered by PharmaLink Digital</p>

</body>

</html>