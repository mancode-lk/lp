<?php
include 'backend/conn.php'; // Database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted Orders</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        /* Custom Styles for Tailwind DataTables Integration */
        table.dataTable {
            width: 100% !important;
        }
        .dataTables_wrapper {
            padding: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <!-- Page Title -->
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Deleted Orders</h1>

    <!-- Filters Section -->
    <div class="bg-white p-4 rounded-lg shadow-lg mb-8">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">Filters</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Start Date -->
            <div>
                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
            </div>
            <!-- End Date -->
            <div>
                <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" id="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
            </div>
            <!-- Apply Filters Button -->
            <div class="flex items-end">
                <button id="filterBtn" class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-md">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white p-4 rounded-lg shadow-lg overflow-x-auto">
        <table id="deletedOrdersTable" class="display stripe hover w-full">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Number</th>
                <th>Customer Name</th>
                <th>City</th>
                <th>COD Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Phone Number</th> <!-- Added header for phone number -->

            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#deletedOrdersTable').DataTable({
            ajax: {
                url: 'backend/get_deleted_orders.php', // Backend script to fetch data
                type: 'POST',
                data: function (d) {
                    // Pass additional filter parameters
                    d.startDate = $('#startDate').val();
                    d.endDate = $('#endDate').val();
                }
            },
           columns: [
    {data: 'or_id'},
    {data: 'or_number'},
    {data: 'c_name'},
    {data: 'city'},
    {data: 'cod_amount'},
    {data: 'or_status'},
    {data: 'or_date'},
    {data: 'c_phone'} // Added column for phone number
],

            serverSide: true,
            processing: true,
            responsive: true
        });

        // Filter Button Click
        $('#filterBtn').click(function () {
            table.ajax.reload(); // Reload table data with new filters
        });
    });
</script>
</body>
</html>
