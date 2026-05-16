@php
    $role = auth()->user()?->role;
    $linkClass = 'block rounded-md px-3 py-2 text-sm font-semibold text-[#f8ead8] transition hover:bg-white/10';
@endphp

<aside class="border-b border-white/10 bg-[#3a281f] text-white lg:min-h-screen lg:w-72 lg:border-b-0 lg:border-r">
    <div class="px-4 py-5 sm:px-6 lg:px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <span class="grid h-10 w-10 place-items-center rounded-lg bg-[#d9773f] font-extrabold">KL</span>
            <span>
                <span class="block text-lg font-extrabold">KriyaLokal</span>
                <span class="block text-xs text-[#e7c7aa]">Dashboard operasional</span>
            </span>
        </a>

        <nav class="mt-8 flex gap-2 overflow-x-auto pb-2 lg:flex-col lg:overflow-visible lg:pb-0">
            @if ($role === 'employee')
                <a href="{{ route('employee.dashboard') }}" class="{{ $linkClass }}">Dashboard</a>
                <span class="{{ $linkClass }}">Premium Monitoring</span>
                <span class="{{ $linkClass }}">Seller Reports</span>
                <span class="{{ $linkClass }}">Report Corrections</span>
            @else
                <a href="{{ route('admin.dashboard') }}" class="{{ $linkClass }}">Dashboard</a>
                <span class="{{ $linkClass }}">Users</span>
                <span class="{{ $linkClass }}">Sellers</span>
                <span class="{{ $linkClass }}">Products</span>
                <span class="{{ $linkClass }}">Orders</span>
                <span class="{{ $linkClass }}">System Maintenance</span>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="lg:mt-4">
                @csrf
                <button type="submit" class="{{ $linkClass }} w-full text-left">Logout</button>
            </form>
        </nav>
    </div>
</aside>
