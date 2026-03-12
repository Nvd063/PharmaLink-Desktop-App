<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PharmaLink | Intelligent Pharmacy OS</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
body{
font-family:'Plus Jakarta Sans',sans-serif;
}
.glass{
background:rgba(255,255,255,0.7);
backdrop-filter:blur(10px);
}
</style>

</head>

<body class="bg-slate-50 text-slate-800">

<!-- NAVBAR -->

<nav class="max-w-7xl mx-auto flex justify-between items-center px-6 py-6">

<div class="flex items-center gap-2">

<div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-emerald-400 font-bold">
PL
</div>

<h1 class="text-xl font-extrabold">
Pharma<span class="text-emerald-600">Link</span>
</h1>

</div>

<div class="flex gap-6 items-center">

<a href="#" class="text-sm font-semibold">Features</a>
<a href="#" class="text-sm font-semibold">Modules</a>
<a href="#" class="text-sm font-semibold">Pricing</a>

<a href="{{ route('login') }}"
class="bg-slate-900 text-white px-6 py-2 rounded-xl text-sm font-semibold">
Login
</a>

</div>

</nav>


<!-- HERO SECTION -->

<section class="text-center max-w-5xl mx-auto px-6 py-24">

<h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">

Smart Software for  
<span class="text-emerald-600">Modern Pharmacies</span>

</h1>

<p class="text-lg text-slate-500 max-w-2xl mx-auto mb-10">

Manage medicines, track expiry dates, control inventory, and generate receipts — all in one intelligent pharmacy management system.

</p>

<div class="flex justify-center gap-6 flex-wrap">

<a href="{{ url('/dashboard') }}"
class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-semibold shadow-lg hover:bg-emerald-600 transition">

Launch System

</a>

<a href="#features"
class="border border-slate-300 px-8 py-4 rounded-2xl font-semibold">

Explore Features

</a>

</div>

</section>


<!-- FEATURES -->

<section id="features" class="max-w-7xl mx-auto px-6 py-20">

<div class="text-center mb-16">

<h2 class="text-4xl font-bold mb-4">
Powerful Pharmacy Features
</h2>

<p class="text-slate-500">
Everything you need to manage a pharmacy business.
</p>

</div>

<div class="grid md:grid-cols-3 gap-10">

<div class="bg-white p-8 rounded-2xl shadow-sm">

<h3 class="text-xl font-bold mb-2">Real-Time Inventory</h3>

<p class="text-slate-500">
Track medicine stock instantly and avoid running out of important items.
</p>

</div>

<div class="bg-white p-8 rounded-2xl shadow-sm">

<h3 class="text-xl font-bold mb-2">Expiry Alerts</h3>

<p class="text-slate-500">
Get automatic alerts before medicines expire.
</p>

</div>

<div class="bg-white p-8 rounded-2xl shadow-sm">

<h3 class="text-xl font-bold mb-2">Fast Billing</h3>

<p class="text-slate-500">
Generate professional receipts within seconds.
</p>

</div>

</div>

</section>


<!-- SYSTEM MODULES -->

<section class="bg-white py-24">

<div class="max-w-7xl mx-auto px-6">

<div class="text-center mb-16">

<h2 class="text-4xl font-bold mb-4">
Complete Pharmacy Management
</h2>

<p class="text-slate-500">
All modules needed to run a pharmacy business.
</p>

</div>

<div class="grid md:grid-cols-4 gap-8 text-center">

<div class="p-6">
<h4 class="font-bold mb-2">POS Billing</h4>
<p class="text-sm text-slate-500">Quick counter billing system</p>
</div>

<div class="p-6">
<h4 class="font-bold mb-2">Inventory</h4>
<p class="text-sm text-slate-500">Medicine stock management</p>
</div>

<div class="p-6">
<h4 class="font-bold mb-2">Suppliers</h4>
<p class="text-sm text-slate-500">Purchase & supplier records</p>
</div>

<div class="p-6">
<h4 class="font-bold mb-2">Reports</h4>
<p class="text-sm text-slate-500">Sales & profit analytics</p>
</div>

</div>

</div>

</section>


<!-- CALL TO ACTION -->

<section class="py-24 text-center">

<div class="max-w-3xl mx-auto">

<h2 class="text-4xl font-bold mb-6">
Start Managing Your Pharmacy Smarter
</h2>

<p class="text-slate-500 mb-10">
PharmaLink helps pharmacies automate inventory, sales, and reporting.
</p>

<a href="{{ route('register') }}"
class="bg-emerald-600 text-white px-10 py-4 rounded-2xl font-semibold shadow-lg hover:bg-emerald-700">

Get Started

</a>

</div>

</section>


<!-- FOOTER -->

<footer class="bg-slate-900 text-slate-400 py-10">

<div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">

<p class="text-sm">
© 2026 PharmaLink. All rights reserved.
</p>

<div class="flex gap-6 text-sm">

<a href="#">Privacy</a>
<a href="#">Terms</a>
<a href="#">Contact</a>

</div>

</div>

</footer>


</body>
</html>