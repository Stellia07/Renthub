{{-- resources/views/rent_receipt.blade.php --}}
@extends('owner.owner_dashboard')

@section('owner')
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .receipt-container {
        width: 60%;
        /* Adjusted for better visibility */
        margin: 0 auto;
        padding: 20px;
        border: 2px solid #000;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .content-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        align-items: center;
        /* Ensure alignment */
    }

    .content-row label {
        flex: 0 0 120px;
    }

    /* Style for input elements in form */
    .content-row input {
        flex: 1;
        border: none;
        border-bottom: 1px solid #000;
        padding: 5px;
    }

    /* Added styles for span elements to mimic read-only inputs */
    .content-row span {
        flex: 1;
        padding: 5px;
        border-bottom: 1px solid #000;
        /* Mimic the border of input */
        display: block;
        /* Make it take the full width */
    }

    .signature {
        border-top: 1px solid #000;
        padding-top: 10px;
        margin-top: 20px;
        text-align: right;
    }
</style>


<body>
    <div class="receipt-container">
        <div class="header">
            <h2>Rent Receipt</h2>
        </div>
        <!-- Display data without input fields, just text -->
        <div class="content-row">
            <label>Date of Payment:</label>
            <span>{{ $dateOfPayment }}</span>
        </div>
        <div class="content-row">
            <label>Receipt Number:</label>
            <span>{{ $receiptNumber }}</span>
        </div>
        <div class="content-row">
            <label>Amount Paid:</label>
            <span>{{ $amountPaid }}</span>
        </div>
        <div class="content-row">
            <label>Property Address:</label>
            <span>{{ $propertyAddress }}</span>
        </div>
        <div class="content-row">
            <label>Tenant’s Name:</label>
            <span>{{ $tenantName }}</span>
        </div>
        <div class="content-row">
            <label>Landlord’s Name:</label>
            <span>{{ $landlordName }}</span>
        </div>
        <div class="signature">
            <label>Signature of the Landlord:</label>
            <span>{{ $landlordName }}</span> <!-- Assuming this is a placeholder -->
        </div>
    </div>
</body>

</html>
@endsection
