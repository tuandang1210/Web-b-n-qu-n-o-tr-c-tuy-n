@extends('admin.layout')

@section('content')

<h3>Dashboard</h3>

<div class="card p-3">
    <canvas id="ordersChart"></canvas>
</div>

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



<script>
const ctx = document.getElementById('ordersChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
        datasets: [{
            label: 'Orders',
            data: @json($ordersPerDay),
            backgroundColor: 'rgba(54,162,235,0.6)'
        }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true }} }
});
</script>

@endsection
