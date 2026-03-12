<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS — PharmaLink</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:         #08090b;
            --bg2:        #0d0f13;
            --surface:    #111318;
            --surface2:   #161921;
            --surface3:   #1c2028;
            --border:     rgba(255,255,255,0.06);
            --border2:    rgba(255,255,255,0.1);
            --text:       #d4d8e2;
            --text2:      #6b7280;
            --text3:      #3d4451;
            --green:      #10b981;
            --green-d:    #059669;
            --green-bg:   rgba(16,185,129,0.07);
            --red:        #ef4444;
            --red-bg:     rgba(239,68,68,0.06);
            --radius:     12px;
        }

        html, body {
            height: 100%;
            background: var(--bg);
            color: var(--text);
            font-family: 'Instrument Sans', sans-serif;
            font-size: 13.5px;
            -webkit-font-smoothing: antialiased;
        }

        [x-cloak] { display: none !important; }

        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.08); border-radius: 3px; }

        /* ── Layout ── */
        .page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .topbar {
            height: 58px;
            background: var(--bg2);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            flex-shrink: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-mark {
            width: 30px; height: 30px;
            border-radius: 7px;
            background: var(--green);
            display: flex; align-items: center; justify-content: center;
        }

        .brand-name {
            font-family: 'Instrument Serif', serif;
            font-size: 17px;
            color: #e8eaf0;
            letter-spacing: -0.02em;
        }

        .brand-name em { font-style: normal; color: var(--green); }

        .topbar-tag {
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text3);
            border: 1px solid var(--border);
            background: var(--surface);
            padding: 4px 12px;
            border-radius: 100px;
        }

        .exit-btn {
            font-size: 11px;
            font-weight: 600;
            color: var(--text2);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.15s;
        }

        .exit-btn:hover { color: var(--red); }

        /* ── Main content ── */
        .main {
            flex: 1;
            display: flex;
            overflow: hidden;
        }

        /* ── Left panel ── */
        .left-panel {
            width: 380px;
            flex-shrink: 0;
            background: var(--bg2);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            padding: 24px 20px;
            gap: 20px;
        }

        .panel-section {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
        }

        .section-label {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: var(--text3);
            margin-bottom: 14px;
        }

        /* TomSelect override */
        .ts-wrapper { margin-bottom: 12px; }

        .ts-control {
            background: var(--surface2) !important;
            border: 1px solid var(--border2) !important;
            border-radius: 8px !important;
            padding: 10px 12px !important;
            font-size: 13px !important;
            font-family: 'Instrument Sans', sans-serif !important;
            color: var(--text) !important;
            box-shadow: none !important;
            min-height: unset !important;
        }

        .ts-control input {
            color: var(--text) !important;
            font-family: 'Instrument Sans', sans-serif !important;
        }

        .ts-dropdown {
            background: var(--surface2) !important;
            border: 1px solid var(--border2) !important;
            border-radius: 8px !important;
            margin-top: 4px !important;
            box-shadow: 0 16px 40px rgba(0,0,0,0.5) !important;
        }

        .ts-dropdown .option {
            padding: 10px 14px !important;
            font-size: 12.5px !important;
            color: var(--text) !important;
            border-bottom: 1px solid var(--border) !important;
        }

        .ts-dropdown .option:last-child { border-bottom: none !important; }
        .ts-dropdown .option:hover,
        .ts-dropdown .option.active { background: var(--green-bg) !important; color: var(--green) !important; }

        .ts-control .item { color: var(--green) !important; font-weight: 600 !important; }

        /* Qty + Add row */
        .add-row {
            display: flex;
            gap: 10px;
        }

        .qty-box {
            width: 72px;
            flex-shrink: 0;
            background: var(--surface2);
            border: 1px solid var(--border2);
            border-radius: 8px;
            text-align: center;
            font-family: 'Instrument Serif', serif;
            font-size: 18px;
            color: var(--text);
            padding: 10px 8px;
        }

        .qty-box:focus { outline: none; border-color: rgba(16,185,129,0.3); }

        .add-btn {
            flex: 1;
            background: var(--green);
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
        }

        .add-btn:hover { background: #0ea572; }
        .add-btn:active { transform: scale(0.98); }

        /* Customer fields */
        .field {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 13px;
            font-family: 'Instrument Sans', sans-serif;
            color: var(--text);
            width: 100%;
            margin-bottom: 10px;
            transition: border-color 0.15s;
        }

        .field:last-child { margin-bottom: 0; }
        .field:focus { outline: none; border-color: rgba(16,185,129,0.3); }
        .field::placeholder { color: var(--text3); }

        /* ── Right panel (cart) ── */
        .right-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--surface);
        }

        .cart-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .cart-title {
            font-family: 'Instrument Serif', serif;
            font-size: 16px;
            color: #d4d8e2;
            letter-spacing: -0.01em;
        }

        .cart-count {
            font-size: 10px;
            font-weight: 600;
            color: var(--green);
            background: var(--green-bg);
            border: 1px solid rgba(16,185,129,0.15);
            padding: 3px 11px;
            border-radius: 100px;
            letter-spacing: 0.04em;
        }

        /* Cart items list */
        .cart-list {
            flex: 1;
            overflow-y: auto;
            padding: 16px 24px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 13px 16px;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            margin-bottom: 8px;
            transition: border-color 0.15s;
        }

        .cart-item:last-child { margin-bottom: 0; }
        .cart-item:hover { border-color: var(--border2); }

        .cart-item-left { display: flex; align-items: center; gap: 13px; }

        .qty-badge {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: var(--surface);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: var(--green);
            flex-shrink: 0;
        }

        .cart-item-name {
            font-weight: 600;
            font-size: 13px;
            color: var(--text);
        }

        .cart-item-price {
            font-size: 11px;
            color: var(--text2);
            margin-top: 2px;
        }

        .cart-item-right { display: flex; align-items: center; gap: 16px; }

        .cart-item-total {
            font-family: 'Instrument Serif', serif;
            font-size: 15px;
            color: #c8ccd6;
            letter-spacing: -0.01em;
        }

        .remove-btn {
            width: 28px; height: 28px;
            border-radius: 6px;
            background: transparent;
            border: none;
            color: var(--text3);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.15s;
        }

        .remove-btn:hover { background: var(--red-bg); color: var(--red); }
        .remove-btn svg { width: 14px; height: 14px; stroke-width: 2; }

        /* Empty state */
        .empty-state {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 0;
            color: var(--text3);
        }

        .empty-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            background: var(--surface2);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
        }

        .empty-icon svg { width: 22px; height: 22px; stroke-width: 1.5; }

        .empty-text {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text3);
        }

        /* ── Cart footer / total ── */
        .cart-footer {
            padding: 20px 24px;
            border-top: 1px solid var(--border);
            background: var(--bg2);
            flex-shrink: 0;
        }

        .total-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .total-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text2);
            margin-bottom: 4px;
        }

        .total-val {
            font-family: 'Instrument Serif', serif;
            font-size: 36px;
            letter-spacing: -0.03em;
            color: #e8eaf0;
            line-height: 1;
        }

        .submit-btn {
            background: var(--green);
            color: #000;
            border: none;
            border-radius: 10px;
            padding: 14px 32px;
            font-size: 12px;
            font-weight: 700;
            font-family: 'Instrument Sans', sans-serif;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background 0.15s, transform 0.1s;
        }

        .submit-btn:hover { background: #0ea572; }
        .submit-btn:active { transform: scale(0.98); }

        .submit-btn svg { width: 15px; height: 15px; stroke-width: 2.2; }

        @media (max-width: 768px) {
            .main { flex-direction: column; overflow: visible; }
            .left-panel { width: 100%; border-right: none; border-bottom: 1px solid var(--border); }
            .right-panel { min-height: 400px; }
        }
    </style>
</head>

<body x-data="saleManager()" x-cloak>
<div class="page">

    <!-- Topbar -->
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">
                <svg width="15" height="15" fill="none" stroke="#000" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <div class="brand-name">Pharma<em>Link</em></div>
        </div>

        <span class="topbar-tag">Point of Sale</span>

        <a href="{{ route('dashboard') }}" class="exit-btn">
            <svg style="width:13px;height:13px;stroke-width:2;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Dashboard
        </a>
    </header>

    <!-- Main -->
    <div class="main">
        <form action="{{ route('receipts.store') }}" method="POST" style="display:contents;">
            @csrf

            <!-- ── Left: Search + Customer ── -->
            <div class="left-panel">

                <!-- Medicine search -->
                <div class="panel-section">
                    <div class="section-label">Search Medicine</div>

                    <select id="medicine-search" placeholder="Type to search…" class="w-full">
                        <option value="">Start typing…</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}"
                            data-price="{{ $product->price }}"
                            data-name="{{ $product->name }}"
                            data-stock="{{ $product->stock }}">
                            {{ $product->name }} — Rs. {{ $product->price }} &nbsp;·&nbsp; Stock: {{ $product->stock }}
                        </option>
                        @endforeach
                    </select>

                    <div class="add-row" style="margin-top:12px;">
                        <input type="number" x-model="qty" min="1" class="qty-box" placeholder="1">
                        <button type="button" @click="addItem" class="add-btn">Add to Bill</button>
                    </div>
                </div>

                <!-- Customer details -->
                <div class="panel-section">
                    <div class="section-label">Customer Details</div>
                    <input type="text"  name="customer_name"  placeholder="Full Name"               class="field">
                    <input type="text"  name="customer_phone" placeholder="Phone Number"             class="field">
                    <input type="email" name="customer_email" placeholder="Email Address (Optional)" class="field">
                </div>

            </div>

            <!-- ── Right: Cart ── -->
            <div class="right-panel">

                <div class="cart-header">
                    <div class="cart-title">Current Bill</div>
                    <span class="cart-count" x-text="cart.length + ' item' + (cart.length !== 1 ? 's' : '')"></span>
                </div>

                <div class="cart-list">

                    <!-- Items -->
                    <template x-for="(item, index) in cart" :key="index">
                        <div class="cart-item">
                            <div class="cart-item-left">
                                <div class="qty-badge" x-text="item.qty"></div>
                                <div>
                                    <div class="cart-item-name" x-text="item.name"></div>
                                    <div class="cart-item-price" x-text="'Rs. ' + item.price.toLocaleString() + ' / unit'"></div>
                                </div>
                            </div>
                            <div class="cart-item-right">
                                <div class="cart-item-total" x-text="'Rs. ' + (item.price * item.qty).toLocaleString()"></div>
                                <button type="button" @click="removeItem(index)" class="remove-btn">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <input type="hidden" :name="'items['+index+'][product_id]'" :value="item.id">
                            <input type="hidden" :name="'items['+index+'][quantity]'"   :value="item.qty">
                        </div>
                    </template>

                    <!-- Empty state -->
                    <div x-show="cart.length === 0" class="empty-state">
                        <div class="empty-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:var(--text3);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        </div>
                        <div class="empty-text">Cart is empty — search a medicine</div>
                    </div>

                </div>

                <!-- Total + Submit -->
                <div class="cart-footer">
                    <div class="total-row">
                        <div>
                            <div class="total-label">Total Payable</div>
                            <div class="total-val" x-text="'Rs. ' + calculateTotal()"></div>
                        </div>
                        <button type="submit" x-show="cart.length > 0" class="submit-btn">
                            Generate Receipt
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>

<script>
    let tsControl;

    document.addEventListener('DOMContentLoaded', function () {
        tsControl = new TomSelect('#medicine-search', {
            create: false,
            sortField: { field: 'text', direction: 'asc' },
            allowEmptyOption: true,
        });
    });

    function saleManager() {
        return {
            qty: 1,
            cart: [],

            addItem() {
                const selectedId = tsControl.getValue();
                if (!selectedId || selectedId === '') {
                    alert('Please select a medicine first.');
                    return;
                }

                const selectEl = document.getElementById('medicine-search');
                const opt = selectEl.options[selectEl.selectedIndex];

                const name  = opt.getAttribute('data-name');
                const price = parseFloat(opt.getAttribute('data-price'));
                const stock = parseInt(opt.getAttribute('data-stock'));

                if (this.qty > stock) {
                    alert(`Only ${stock} units available. You are adding ${this.qty}.`);
                    return;
                }

                const existing = this.cart.find(i => i.id === selectedId);
                if (existing) {
                    if ((parseInt(existing.qty) + parseInt(this.qty)) > stock) {
                        alert('Total quantity exceeds available stock.');
                        return;
                    }
                    existing.qty = parseInt(existing.qty) + parseInt(this.qty);
                } else {
                    this.cart.push({ id: selectedId, name, price, qty: parseInt(this.qty) });
                }

                tsControl.clear();
                this.qty = 1;
            },

            removeItem(index) {
                this.cart.splice(index, 1);
            },

            calculateTotal() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0).toLocaleString();
            }
        };
    }
</script>
</body>
</html>