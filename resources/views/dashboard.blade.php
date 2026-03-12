<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaLink — Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
            --c-bg: #08090b;
            --c-bg2: #0d0f13;
            --c-surface: #111318;
            --c-surface2: #161921;
            --c-border: rgba(255, 255, 255, 0.055);
            --c-border2: rgba(255, 255, 255, 0.1);
            --c-text: #d4d8e2;
            --c-text2: #6b7280;
            --c-text3: #3d4451;
            --c-emerald: #10b981;
            --c-emerald-d: #059669;
            --c-emerald-bg: rgba(16, 185, 129, 0.07);
            --c-blue: #3b82f6;
            --c-blue-bg: rgba(59, 130, 246, 0.07);
            --c-amber: #f59e0b;
            --c-amber-bg: rgba(245, 158, 11, 0.07);
            --c-red: #ef4444;
            --c-red-bg: rgba(239, 68, 68, 0.07);
            --sidebar-w: 248px;
            --topbar-h: 58px;
            --radius: 10px;
        }

        html,
        body {
            height: 100%;
            background: var(--c-bg);
            color: var(--c-text);
            font-family: 'Instrument Sans', sans-serif;
            font-size: 13.5px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        [x-cloak] {
            display: none !important;
        }

        ::-webkit-scrollbar {
            width: 3px;
            height: 3px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.08);
            border-radius: 3px;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: var(--c-bg2);
            border-right: 1px solid var(--c-border);
            display: flex;
            flex-direction: column;
            z-index: 40;
        }

        .sidebar-brand {
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 11px;
            border-bottom: 1px solid var(--c-border);
            flex-shrink: 0;
        }

        .brand-mark {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            background: var(--c-emerald);
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
            color: var(--c-emerald);
        }

        .nav-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 14px 10px;
        }

        .nav-group-label {
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--c-text3);
            padding: 10px 10px 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 10px;
            border-radius: 7px;
            color: var(--c-text2);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.04);
            color: var(--c-text);
        }

        .nav-link.is-active {
            background: var(--c-emerald-bg);
            color: var(--c-emerald);
        }

        .nav-icon {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.04);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.15s;
        }

        .nav-icon svg {
            width: 14px;
            height: 14px;
            stroke-width: 1.8;
        }

        .nav-link.is-active .nav-icon {
            background: rgba(16, 185, 129, 0.12);
        }

        .nav-pill {
            margin-left: auto;
            font-size: 10px;
            font-weight: 600;
            padding: 1px 7px;
            border-radius: 100px;
        }

        .pill-red {
            background: var(--c-red-bg);
            color: var(--c-red);
        }

        .pill-amber {
            background: var(--c-amber-bg);
            color: var(--c-amber);
        }

        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1px solid var(--c-border);
            flex-shrink: 0;
        }

        .hr-nav {
            height: 1px;
            background: var(--c-border);
            margin: 6px 10px;
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: var(--c-bg2);
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 30;
        }

        .page-title {
            font-family: 'Instrument Serif', serif;
            font-size: 20px;
            color: #e2e4ec;
            letter-spacing: -0.02em;
        }

        .page-sub {
            font-size: 11px;
            color: var(--c-text2);
            margin-top: 1px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ── Main ── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }

        .main-content {
            padding: 28px 28px 56px;
        }

        /* ── Stats ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat-card {
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            border-radius: var(--radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s, transform 0.2s;
        }

        .stat-card.is-link {
            cursor: pointer;
        }

        .stat-card.is-link:hover {
            transform: translateY(-1px);
            border-color: var(--c-border2);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
        }

        .accent-green::after {
            background: linear-gradient(90deg, transparent, var(--c-emerald), transparent);
        }

        .accent-red::after {
            background: linear-gradient(90deg, transparent, var(--c-red), transparent);
        }

        .accent-amber::after {
            background: linear-gradient(90deg, transparent, var(--c-amber), transparent);
        }

        .accent-blue::after {
            background: linear-gradient(90deg, transparent, var(--c-blue), transparent);
        }

        .stat-eyebrow {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--c-text2);
            margin-bottom: 10px;
        }

        .stat-val {
            font-family: 'Instrument Serif', serif;
            font-size: 26px;
            letter-spacing: -0.03em;
            line-height: 1;
            color: #e2e4ec;
        }

        .stat-val.green {
            color: var(--c-emerald);
        }

        .stat-val.red {
            color: var(--c-red);
        }

        .stat-val.amber {
            color: var(--c-amber);
        }

        .stat-sub {
            font-size: 11px;
            color: var(--c-text2);
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ── Search ── */
        .search-bar {
            position: relative;
            margin-bottom: 18px;
        }

        .search-bar svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 14px;
            height: 14px;
            color: var(--c-text3);
            stroke-width: 2;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            border-radius: var(--radius);
            padding: 10px 14px 10px 38px;
            font-size: 13px;
            font-family: 'Instrument Sans', sans-serif;
            color: var(--c-text);
            transition: border-color 0.2s;
        }

        .search-input:focus {
            outline: none;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .search-input::placeholder {
            color: var(--c-text3);
        }

        /* ── Table ── */
        .table-card {
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            border-radius: var(--radius);
            overflow: hidden;
        }

        .table-head-row {
            padding: 14px 20px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-head-title {
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: #d4d8e2;
            letter-spacing: -0.01em;
        }

        .table-head-sub {
            font-size: 11px;
            color: var(--c-text2);
            margin-top: 2px;
        }

        table.records {
            width: 100%;
            border-collapse: collapse;
        }

        table.records thead tr {
            border-bottom: 1px solid var(--c-border);
        }

        table.records th {
            padding: 11px 20px;
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--c-text2);
            text-align: left;
        }

        table.records td {
            padding: 13px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.028);
        }

        table.records tbody tr:last-child td {
            border-bottom: none;
        }

        table.records tbody tr:hover {
            background: rgba(255, 255, 255, 0.015);
        }

        .receipt-id {
            font-weight: 600;
            font-size: 13px;
            color: #c9cdd7;
            letter-spacing: 0.01em;
        }

        .receipt-date {
            font-size: 11px;
            color: var(--c-text2);
            margin-top: 2px;
        }

        .customer-name {
            font-weight: 500;
            color: var(--c-text);
        }

        .customer-phone {
            font-size: 11px;
            color: var(--c-emerald);
            margin-top: 2px;
            opacity: 0.8;
        }

        .amount-val {
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: #d4d8e2;
            text-align: right;
            letter-spacing: -0.01em;
        }

        .open-link {
            font-size: 11px;
            font-weight: 600;
            color: var(--c-text2);
            text-decoration: none;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: color 0.15s;
        }

        .open-link:hover {
            color: var(--c-emerald);
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Instrument Sans', sans-serif;
            cursor: pointer;
            border: none;
            transition: all 0.15s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn svg {
            width: 13px;
            height: 13px;
            stroke-width: 2;
            flex-shrink: 0;
        }

        .btn-emerald {
            background: var(--c-emerald);
            color: #000;
        }

        .btn-emerald:hover {
            background: #0ea572;
        }

        .btn-outline {
            background: transparent;
            color: var(--c-text2);
            border: 1px solid var(--c-border2);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.04);
            color: var(--c-text);
        }

        .btn-surface {
            background: var(--c-surface2);
            color: var(--c-text);
            border: 1px solid var(--c-border);
        }

        .btn-surface:hover {
            background: rgba(255, 255, 255, 0.06);
        }

        /* ── Modals ── */
        .overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.72);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .modal {
            background: var(--c-surface);
            border: 1px solid var(--c-border2);
            border-radius: 14px;
            overflow: hidden;
            width: 100%;
            box-shadow: 0 32px 64px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.04);
        }

        .modal-hdr {
            padding: 20px 24px;
            border-bottom: 1px solid var(--c-border);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .modal-title {
            font-family: 'Instrument Serif', serif;
            font-size: 18px;
            color: #d4d8e2;
            letter-spacing: -0.02em;
        }

        .modal-sub {
            font-size: 11px;
            color: var(--c-text2);
            margin-top: 3px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .modal-close {
            width: 28px;
            height: 28px;
            border-radius: 6px;
            background: var(--c-surface2);
            border: 1px solid var(--c-border);
            color: var(--c-text2);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
            transition: all 0.15s;
        }

        .modal-close:hover {
            color: var(--c-text);
            background: rgba(255, 255, 255, 0.06);
        }

        .modal-body {
            padding: 20px 24px;
            overflow-y: auto;
        }

        /* Modal list items */
        .list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            background: var(--c-surface2);
            border: 1px solid var(--c-border);
            border-radius: 8px;
            margin-bottom: 7px;
            transition: border-color 0.15s;
        }

        .list-item:last-child {
            margin-bottom: 0;
        }

        .list-item:hover {
            border-color: var(--c-border2);
        }

        .list-item-name {
            font-weight: 500;
            font-size: 13px;
            color: var(--c-text);
        }

        .list-item-sub {
            font-size: 11px;
            margin-top: 2px;
        }

        .tag {
            padding: 2px 9px;
            border-radius: 100px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        .tag-red {
            background: var(--c-red-bg);
            color: var(--c-red);
        }

        .tag-amber {
            background: var(--c-amber-bg);
            color: var(--c-amber);
        }

        .tag-green {
            background: var(--c-emerald-bg);
            color: var(--c-emerald);
        }

        .tag-blue {
            background: var(--c-blue-bg);
            color: var(--c-blue);
        }

        /* Restock */
        .restock-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            background: var(--c-surface2);
            border: 1px solid var(--c-border);
            border-radius: 8px;
            margin-bottom: 7px;
            transition: border-color 0.15s;
        }

        .restock-row:hover {
            border-color: rgba(16, 185, 129, 0.15);
        }

        .stock-badge {
            width: 36px;
            height: 36px;
            border-radius: 7px;
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: var(--c-emerald);
        }

        .qty-input-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--c-surface);
            border: 1px solid var(--c-border);
            border-radius: 7px;
            padding: 5px 12px;
        }

        .qty-label {
            font-size: 10px;
            font-weight: 600;
            color: var(--c-text3);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .qty-input {
            width: 60px;
            background: transparent;
            border: none;
            font-family: 'Instrument Serif', serif;
            font-size: 16px;
            color: var(--c-text);
            text-align: center;
        }

        .qty-input:focus {
            outline: none;
        }

        .qty-input::placeholder {
            color: var(--c-text3);
        }

        /* Field */
        .field {
            background: var(--c-surface2);
            border: 1px solid var(--c-border);
            border-radius: 7px;
            padding: 9px 12px;
            font-size: 13px;
            font-family: 'Instrument Sans', sans-serif;
            color: var(--c-text);
            width: 100%;
            transition: border-color 0.15s;
        }

        .field:focus {
            outline: none;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .field::placeholder {
            color: var(--c-text3);
        }

        .add-form-wrap {
            background: rgba(16, 185, 129, 0.03);
            border: 1px dashed rgba(16, 185, 129, 0.18);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Reports */
        .report-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 18px;
            background: var(--c-surface2);
            border: 1px solid var(--c-border);
            border-radius: 9px;
            text-decoration: none;
            transition: all 0.15s;
            margin-bottom: 8px;
        }

        .report-option:last-child {
            margin-bottom: 0;
        }

        .report-option:hover {
            border-color: var(--c-border2);
            background: rgba(255, 255, 255, 0.03);
        }

        .report-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--c-text);
        }

        .report-desc {
            font-size: 11px;
            color: var(--c-text2);
            margin-top: 3px;
        }

        .report-icon {
            width: 34px;
            height: 34px;
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .report-icon svg {
            width: 15px;
            height: 15px;
            stroke-width: 1.8;
        }

        /* Anim */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.3s ease both;
        }

        .delay-1 {
            animation-delay: 0.05s;
        }

        .delay-2 {
            animation-delay: 0.1s;
        }

        .delay-3 {
            animation-delay: 0.15s;
        }

        .delay-4 {
            animation-delay: 0.2s;
        }

        .delay-5 {
            animation-delay: 0.25s;
        }

        .section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--c-text3);
            margin-bottom: 12px;
        }
    </style>
</head>

<body x-data="{
    search: '',
    showLowStock: false,
    showRestockModal: false,
    showAddNew: false,
    showTopSelling: false,
    showExpiryAlert: false,
    showReportModal: false
}">

    <!-- ═══════════ SIDEBAR ═══════════ -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-mark">
                <svg width="15" height="15" fill="none" stroke="#000" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
            </div>
            <div class="brand-name">Pharma<em>Link</em></div>
        </div>

        <nav class="nav-scroll">

            <div class="nav-group-label">Overview</div>
            <a href="#" class="nav-link is-active">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                Dashboard
            </a>

            <div class="hr-nav"></div>
            <div class="nav-group-label">Sales</div>

            <a href="{{ route('receipts.create') }}" class="nav-link">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                New Sale
            </a>

            <button class="nav-link" @click="showReportModal = true">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                Reports
            </button>

            <div class="hr-nav"></div>
            <div class="nav-group-label">Inventory</div>

            <button class="nav-link" @click="showRestockModal = true">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V11" />
                    </svg>
                </div>
                Restock Inventory
            </button>

            <button class="nav-link" @click="showLowStock = true">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                Low Stock Alerts
                @if($lowStockCount > 0)
                    <span class="nav-pill pill-red">{{ $lowStockCount }}</span>
                @endif
            </button>

            <button class="nav-link" @click="showExpiryAlert = true">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                Expiry Alerts
                @if($nearExpiryCount > 0)
                    <span class="nav-pill pill-amber">{{ $nearExpiryCount }}</span>
                @endif
            </button>

            <button class="nav-link" @click="showTopSelling = true">
                <div class="nav-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
                Top Selling
            </button>

        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link" style="color:var(--c-text3);"
                    onmouseover="this.style.color='var(--c-red)';this.style.background='var(--c-red-bg)'"
                    onmouseout="this.style.color='var(--c-text3)';this.style.background='transparent'">
                    <div class="nav-icon">
                        <svg style="width:14px;height:14px;stroke-width:1.8;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>


    <!-- ═══════════ TOPBAR + MAIN ═══════════ -->
    <div class="main-wrap">

        <header class="topbar">
            <div>
                <div class="page-title">Dashboard</div>
                <div class="page-sub">Inventory &amp; Sales Overview</div>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('receipts.create') }}" class="btn btn-emerald">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New Sale
                </a>
                <button @click="showRestockModal = true" class="btn btn-surface">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 10V11" />
                    </svg>
                    Restock
                </button>
                <button @click="showReportModal = true" class="btn btn-outline">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Reports
                </button>
            </div>
        </header>

        <main class="main-content">

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card accent-green fade-up" style="grid-column:span 2;">
                    <div class="stat-eyebrow">Net Revenue</div>
                    <div class="stat-val green">Rs. {{ number_format($totalRevenue, 0) }}</div>
                    <div class="stat-sub">
                        <svg style="width:11px;height:11px;stroke-width:2;" fill="none" stroke="var(--c-emerald)"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Total cumulative earnings
                    </div>
                </div>

                <div class="stat-card fade-up delay-1">
                    <div class="stat-eyebrow">Transactions</div>
                    <div class="stat-val">{{ $receiptsCount }}</div>
                    <div class="stat-sub">Bills generated</div>
                </div>

                <div class="stat-card accent-red is-link fade-up delay-2" @click="showLowStock = true">
                    <div class="stat-eyebrow">Low Stock</div>
                    <div class="stat-val red">{{ $lowStockCount }}</div>
                    <div class="stat-sub">Active alerts &nbsp;↗</div>
                </div>

                <div class="stat-card accent-amber is-link fade-up delay-3" @click="showExpiryAlert = true">
                    <div class="stat-eyebrow">Near Expiry</div>
                    <div class="stat-val amber">{{ $nearExpiryCount }}</div>
                    <div class="stat-sub">Items expiring soon &nbsp;↗</div>
                </div>
            </div>

            <!-- Search -->
            <div class="search-bar fade-up delay-4">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" x-model="search" placeholder="Search receipt ID, customer name or phone…"
                    class="search-input">
            </div>

            <!-- Table -->
            <div class="table-card fade-up delay-5">
                <div class="table-head-row">
                    <div>
                        <div class="table-head-title">Transactions</div>
                        <div class="table-head-sub">All sales records</div>
                    </div>
                    <span class="tag tag-green">{{ $receiptsCount }} total</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="records">
                        <thead>
                            <tr>
                                <th>Receipt</th>
                                <th>Customer</th>
                                <th style="text-align:right;">Amount</th>
                                <th style="text-align:center;">Bill</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($receipts as $receipt)
                                <tr
                                    x-show="'{{ $receipt->receipt_handle }} {{ optional($receipt->customer)->name }} {{ optional($receipt->customer)->phone }}'.toLowerCase().includes(search.toLowerCase())">
                                    <td>
                                        <div class="receipt-id">{{ $receipt->receipt_handle }}</div>
                                        <div class="receipt-date">{{ $receipt->created_at->format('d M Y · H:i') }}</div>
                                    </td>
                                    <td>
                                        <div class="customer-name">{{ $receipt->customer->name ?? 'Walk-in' }}</div>
                                        <div class="customer-phone">{{ $receipt->customer->phone ?? '—' }}</div>
                                    </td>
                                    <td>
                                        <div class="amount-val">Rs. {{ number_format($receipt->total_amount, 2) }}</div>
                                    </td>
                                    <td style="text-align:center;">
                                        <a href="{{ route('receipt.public.view', $receipt->receipt_handle) }}"
                                            target="_blank" class="open-link">
                                            Open
                                            <svg style="width:11px;height:11px;stroke-width:2;" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        style="text-align:center;padding:56px;color:var(--c-text3);font-size:12px;letter-spacing:0.08em;text-transform:uppercase;">
                                        No records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>


    <!-- ═══════════ MODALS ═══════════ -->

    <!-- Low Stock -->
    <div x-show="showLowStock" x-cloak class="overlay" style="z-index:110;">
        <div @click.away="showLowStock = false" class="modal" style="max-width:460px;">
            <div class="modal-hdr">
                <div>
                    <div class="modal-title">Low Stock Alerts</div>
                    <div class="modal-sub">Below 10 units threshold</div>
                </div>
                <button class="modal-close" @click="showLowStock = false">&times;</button>
            </div>
            <div class="modal-body" style="max-height:440px;">
                @foreach($lowStockMedicines as $product)
                    <div class="list-item">
                        <div>
                            <div class="list-item-name">{{ $product->name }}</div>
                            <div class="list-item-sub" style="color:var(--c-red);">{{ $product->stock }} units remaining
                            </div>
                        </div>
                        <span class="tag tag-red">Low</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top Selling -->
    <div x-show="showTopSelling" x-cloak class="overlay" style="z-index:110;">
        <div @click.away="showTopSelling = false" class="modal" style="max-width:460px;">
            <div class="modal-hdr">
                <div>
                    <div class="modal-title">Top Selling Products</div>
                    <div class="modal-sub">Best performing items</div>
                </div>
                <button class="modal-close" @click="showTopSelling = false">&times;</button>
            </div>
            <div class="modal-body" style="max-height:440px;">
                @foreach($topSelling as $item)
                    <div class="list-item">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div
                                style="width:28px;height:28px;border-radius:6px;background:var(--c-blue-bg);color:var(--c-blue);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0;">
                                #{{ $loop->iteration }}</div>
                            <div>
                                <div class="list-item-name">{{ $item->product->name }}</div>
                                <div class="list-item-sub" style="color:var(--c-text2);">{{ $item->total_sold }} units sold
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Expiry -->
    <div x-show="showExpiryAlert" x-cloak class="overlay" style="z-index:110;">
        <div @click.away="showExpiryAlert = false" class="modal" style="max-width:460px;">
            <div class="modal-hdr">
                <div>
                    <div class="modal-title">Expiry Alerts</div>
                    <div class="modal-sub">Expired or expiring soon</div>
                </div>
                <button class="modal-close" @click="showExpiryAlert = false">&times;</button>
            </div>
            <div class="modal-body" style="max-height:440px;">
                @forelse($nearExpiry as $product)
                    <div class="list-item">
                        <div>
                            <div class="list-item-name">{{ $product->name }}</div>
                            <div class="list-item-sub"
                                style="color:{{ $product->expiry_date->isPast() ? 'var(--c-red)' : 'var(--c-amber)' }};">
                                {{ $product->expiry_date->isPast() ? 'Expired' : 'Expires' }}:
                                {{ $product->expiry_date->format('d M Y') }}
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <span class="{{ $product->expiry_date->isPast() ? 'tag tag-red' : 'tag tag-amber' }}">
                                {{ $product->expiry_date->isPast() ? 'Expired' : 'Soon' }}
                            </span>
                            <div style="font-size:11px;color:var(--c-text2);margin-top:4px;">{{ $product->stock }} units
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center;padding:40px 0;color:var(--c-text2);">
                        <div style="font-size:26px;margin-bottom:8px;">✓</div>
                        <div style="font-size:12px;">No items near expiry</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Restock -->
    <div x-show="showRestockModal" x-cloak class="overlay" style="z-index:150;">
        <div @click.away="showRestockModal = false" class="modal"
            style="max-width:680px;max-height:88vh;display:flex;flex-direction:column;">
            <div class="modal-hdr" style="flex-shrink:0;">
                <div>
                    <div class="modal-title">Inventory Management</div>
                    <div class="modal-sub">Restock or register new medicines</div>
                </div>
                <div style="display:flex;gap:8px;align-items:center;">
                    <button @click="showAddNew = !showAddNew" class="btn btn-emerald" style="font-size:11px;">+ New
                        Medicine</button>
                    <button class="modal-close" @click="showRestockModal = false">&times;</button>
                </div>
            </div>
            <div class="modal-body" style="flex:1;overflow-y:auto;">

                <div x-show="showAddNew" x-transition class="add-form-wrap">
                    <div class="section-label" style="color:var(--c-emerald);margin-bottom:14px;">Register New Product
                    </div>
                    <form action="{{ route('products.store') }}" method="POST"
                        style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;">
                        @csrf
                        <input type="text" name="name" placeholder="Medicine Name" class="field" required>
                        <input type="number" name="price" placeholder="Price (Rs.)" class="field" required>
                        <input type="number" name="stock" placeholder="Initial Qty" class="field" required>
                        <input type="date" name="expiry_date" class="field" required>
                        <div style="grid-column:span 4;text-align:right;margin-top:4px;">
                            <button type="submit" class="btn btn-emerald">Save to Database</button>
                        </div>
                    </form>
                </div>

                <div class="section-label">Low Stock — Enter Quantities to Add</div>

                <form action="{{ route('products.bulk-restock') }}" method="POST">
                    @csrf
                    @foreach($lowStockMedicines as $product)
                        <div class="restock-row">
                            <div style="display:flex;align-items:center;gap:12px;">
                                <div class="stock-badge">{{ $product->stock }}</div>
                                <div>
                                    <div style="font-weight:500;font-size:13px;color:var(--c-text);">{{ $product->name }}
                                    </div>
                                    <div style="font-size:11px;color:var(--c-text2);margin-top:2px;">{{ $product->stock }}
                                        units in stock</div>
                                </div>
                            </div>
                            <div class="qty-input-wrap">
                                <span class="qty-label">Add</span>
                                <input type="number" name="restock[{{ $product->id }}]" class="qty-input" placeholder="0">
                            </div>
                        </div>
                    @endforeach
                    <div style="margin-top:16px;">
                        <button type="submit" class="btn btn-emerald"
                            style="width:100%;justify-content:center;padding:11px;">
                            Update Inventory
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reports -->
    <div x-show="showReportModal" x-cloak class="overlay" style="z-index:160;">
        <div @click.away="showReportModal = false" class="modal" style="max-width:380px;">
            <div class="modal-hdr">
                <div>
                    <div class="modal-title">Business Reports</div>
                    <div class="modal-sub">Select period to download</div>
                </div>
                <button class="modal-close" @click="showReportModal = false">&times;</button>
            </div>
            <div class="modal-body">
                <a href="{{ route('reports.download', 'weekly') }}" class="report-option">
                    <div>
                        <div class="report-name">Weekly Report</div>
                        <div class="report-desc">Last 7 days of sales data</div>
                    </div>
                    <div class="report-icon" style="background:var(--c-blue-bg);">
                        <svg fill="none" stroke="var(--c-blue)" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                    </div>
                </a>
                <a href="{{ route('reports.download', 'monthly') }}" class="report-option">
                    <div>
                        <div class="report-name">Monthly Report</div>
                        <div class="report-desc">Full month analytics &amp; breakdown</div>
                    </div>
                    <div class="report-icon" style="background:var(--c-emerald-bg);">
                        <svg fill="none" stroke="var(--c-emerald)" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- QR Success -->
    @if(session('qrCode'))
        <div
            style="position:fixed;inset:0;background:rgba(0,0,0,0.82);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;z-index:200;padding:16px;">
            <div
                style="background:var(--c-surface);border:1px solid var(--c-border2);border-radius:14px;padding:36px;max-width:320px;width:100%;text-align:center;">
                <div
                    style="width:48px;height:48px;background:var(--c-emerald-bg);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                    <svg style="width:20px;height:20px;" fill="none" stroke="var(--c-emerald)" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div style="font-family:'Instrument Serif',serif;font-size:20px;color:#e2e4ec;margin-bottom:4px;">Sale
                    Complete</div>
                <p
                    style="font-size:11px;color:var(--c-text2);letter-spacing:0.08em;text-transform:uppercase;margin-bottom:22px;">
                    Show QR to customer</p>
                <div style="background:#fff;border-radius:10px;padding:16px;display:inline-flex;margin-bottom:20px;">
                    {!! session('qrCode') !!}
                </div>
                <button onclick="window.location.reload()" class="btn btn-emerald"
                    style="width:100%;justify-content:center;padding:10px;">
                    Done
                </button>
            </div>
        </div>
    @endif

</body>

</html>