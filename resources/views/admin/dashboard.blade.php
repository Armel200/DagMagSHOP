@extends('admin.admin')

@section('title', 'Dashboard - DacMagSHOP')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600"><ion-icon name="person-outline" class="text-xl"></ion-icon>Total customer</p>
            <p class="text-2xl font-bold">100,883 <span class="text-green-500">↑2.5%</span></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600"><ion-icon name="logo-euro"></ion-icon>Total revenue</p>
            <p class="text-2xl font-bold">500K fcfa <span class="text-green-500">↑0.5%</span></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600"><ion-icon name="receipt-outline" class="text-xl"></ion-icon><span>Total order</p>
            <p class="text-2xl font-bold">1.136M <span class="text-red-500">↓0.2%</span></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-gray-600">Total return</p>
            <p class="text-2xl font-bold">1.788 <span class="text-green-500">↑0.12%</span></p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold mb-4">Product sales</h3>
        <div>
            <canvas id="productSalesChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-4">Sales by product category</h3>
            <div>
                <canvas id="salesByCategoryChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-4">Sales by city</h3>
            <div>
                <canvas id="salesByCityChart"></canvas>
            </div>
            {{-- <ul class="mt-4 text-sm">
                <li>Yaoundé: 45%</li>
                <li>Douala: 20%</li>
                <li>Ebolowa: 10%</li>
                <li>Bertoua: 5%</li>
                <li>Bafoussam: 0.8%</li>
            </ul> --}}
        </div>
    </div>

    <script>
        // Product Sales Chart (Bar)
        const productSalesCtx = document.getElementById('productSalesChart').getContext('2d');
        new Chart(productSalesCtx, {
            type: 'bar',
            data: {
                labels: ['1 Jul', '3 Jul', '4 Jul', '5 Jul', '6 Jul', '7 Jul', '8 Jul', '9 Jul', '10 Jul', '11 Jul', '12 Jul'],
                datasets: [{
                    label: 'Gross margin',
                    data: [20000, 25000, 30000, 35000, 40000, 45000, 30000, 20000, 25000, 30000, 40000],
                    backgroundColor: 'rgba(59, 130, 246, 0.8)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }, {
                    label: 'Revenu',
                    data: [30000, 35000, 40000, 45000, 50000, 55000, 40000, 30000, 35000, 40000, 50000],
                    backgroundColor: 'rgba(251, 191, 36, 0.8)',
                    borderColor: 'rgba(251, 191, 36, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Sales by Product Category Chart (Doughnut)
        const salesByCategoryCtx = document.getElementById('salesByCategoryChart').getContext('2d');
        new Chart(salesByCategoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Bags en perles', 'Accessoires', 'Vêtements', 'Décor', 'Kids'],
                datasets: [{
                    data: [25, 13, 9, 5, 17],
                    backgroundColor: ['#EF4444', '#F59E0B', '#3B82F6', '#8B5CF6', '#10B981']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Sales by City Chart (Doughnut)
        const salesByCityCtx = document.getElementById('salesByCityChart').getContext('2d');
        new Chart(salesByCityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Yaoundé', 'Douala', 'Ebolowa', 'Bertoua', 'Bafoussam'],
                datasets: [{
                    data: [45, 20, 10, 5, 0.8],
                    backgroundColor: ['#F97316', '#FDBA74', '#FCD34D', '#D1D5DB', '#9CA3AF']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endsection