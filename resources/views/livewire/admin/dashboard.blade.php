<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Sales --}}
        <div class="bg-gray-200 dark:bg-dark-800 border-l-4 border-sky-500 p-5 rounded-xl shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Sales</h3>
                    <h2 class="text-3xl font-bold text-sky-500">{{ $totalSales }}</h2>
                </div>
                <div class="bg-sky-500 text-white rounded-full py-3 px-5">
                    <i class="fa-solid fa-file-invoice-dollar text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Customers --}}
        <div class="bg-gray-200 dark:bg-dark-800 border-l-4 border-red-500 p-5 rounded-xl shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Customers</h3>
                    <h2 class="text-3xl font-bold text-red-500">{{ $totalCustomer }}</h2>
                </div>
                <div class="bg-red-500 text-white rounded-full p-3">
                    <i class="fa-solid fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Products --}}
        <div class="bg-gray-200 dark:bg-dark-800 border-l-4 border-yellow-500 p-5 rounded-xl shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Products</h3>
                    <h2 class="text-3xl font-bold text-yellow-500">{{ $totalProduct }}</h2>
                </div>
                <div class="bg-yellow-500 text-white rounded-full p-3">
                    <i class="fa-solid fa-shop text-2xl"></i>
                </div>
            </div>
        </div>

        {{-- Total Invoices --}}
        <div class="bg-gray-200 dark:bg-dark-800 border-l-4 border-green-500 p-5 rounded-xl shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-white">Total Invoices</h3>
                    <h2 class="text-3xl font-bold text-green-500">{{ $totalInvoice }}</h2>
                </div>
                <div class="bg-green-500 text-white rounded-full py-3 px-5">
                    <i class="fa-solid fa-receipt text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col xl:flex-row gap-6 mt-10">
        <!-- Sales Chart - Flexible width -->
        <div
            class="flex-1 min-w-0 bg-white rounded-lg shadow-sm dark:bg-gray-800 p-6 transition-all duration-300 sidebar-expanded:w-[calc(100%-24rem)]">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white">
                        ₹{{ array_sum($salesTotals) }}
                    </h5>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">Sales This Week</p>
                </div>
                <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500">
                    +23%
                    <svg class="w-3 h-3 ms-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                </div>
            </div>
            <div>
                <canvas id="salesFlowChart" height="100" data-labels='@json($salesLabels)'
                    data-totals='@json($salesTotals)'></canvas>
            </div>
        </div>

        <!-- Profit Chart - Flexible width -->
        <div
            class="flex-1 min-w-0 bg-white rounded-lg shadow-sm dark:bg-gray-800 p-6 transition-all duration-300 sidebar-expanded:w-[calc(100%-24rem)]">
            <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
                <dl>
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Profit</dt>
                    <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">$5,405</dd>
                </dl>
                <div>
                    <span
                        class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13V1m0 0L1 5m4-4 4 4" />
                        </svg>
                        Profit rate 23.5%
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-2 py-3">
                <dl>
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Income</dt>
                    <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400">$23,635</dd>
                </dl>
                <dl>
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
                    <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">-$18,230</dd>
                </dl>
            </div>
            <div id="bar-chart"></div>
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                    <!-- Dropdown button and other elements -->
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('salesFlowChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($salesLabels), // e.g. ['Mon', 'Tue', 'Wed']
                datasets: [{
                    label: 'Sales',
                    data: @json($salesTotals), // e.g. [120, 140, 100]
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => '₹' + value
                        }
                    }
                }
            }
        });
    });

    function updateChartSizes() {
        const sidebar = document.getElementById('sidebar');
        const charts = document.querySelectorAll('.sidebar-expanded');

        if (sidebar.classList.contains('expanded')) {
            charts.forEach(chart => {
                chart.classList.add('w-[calc(100%-24rem)]');
                chart.classList.remove('w-full');
            });
        } else {
            charts.forEach(chart => {
                chart.classList.remove('w-[calc(100%-24rem)]');
                chart.classList.add('w-full');
            });
        }
    }

    // Call this when sidebar state changes
    document.getElementById('mobile-menu-button').addEventListener('click', updateChartSizes);
    document.getElementById('logo-btn').addEventListener('click', updateChartSizes);

    // Initialize on load
    window.addEventListener('load', updateChartSizes);
</script>


</div>