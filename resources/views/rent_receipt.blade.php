@extends('owner.owner_dashboard')

@section('owner')
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .receipt-container {
        width: 40%;
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
    }

    .content-row label {
        flex: 0 0 120px;
    }

    .content-row input, .content-row select {
        flex: 1;
        border: none;
        border-bottom: 1px solid #000;
        padding: 5px;
    }

    .signature {
        border-top: 1px solid #000;
        padding-top: 10px;
        margin-top: 20px;
        text-align: right;
    }
</style>

<body>
    @php
        $rentBills = [];
        if (isset($tenantName)) {
            $tenant = App\Models\User::where('name', $tenantName)->first();
            if ($tenant) {
                $tenantEmail = $tenant->email;
                $rentBills = App\Models\RentBill::where('tenant_email', $tenantEmail)->whereNull('receipt_id')->get();
            }
        }
    @endphp

    <form method="POST" action="{{ route('rent-receipts.store') }}">
        @csrf
        <div class="receipt-container">
            <div class="header">
                <h2>Rent Receipt</h2>
            </div>
            <div class="content-row">
                <label for="date_of_payment">Date of Payment:</label>
                <input id="date_of_payment" name="date_of_payment" type="date" value="{{ old('date_of_payment', $dateOfPayment ?? '') }}">
            </div>
            <div class="content-row">
                <label for="receipt_number">Receipt Number:</label>
                <input id="receipt_number" name="receipt_number" type="text" value="{{ old('receipt_number', $receiptNumber ?? '') }}" readonly>
            </div>
            <div class="content-row">
                <label for="amount_paid">Amount Paid:</label>
                <input id="amount_paid" name="amount_paid" type="text" value="{{ old('amount_paid', $amountPaid ?? '') }}" readonly>
            </div>
            <div class="content-row">
                <label for="property_address">Property Address:</label>
                <input id="property_address" name="property_address" type="text" value="{{ old('property_address', $propertyAddress ?? '') }}" readonly>
            </div>
            <div class="content-row">
                <label for="tenant_name">Tenant’s Name:</label>
                <input id="tenant_name" name="tenant_name" type="text" value="{{ old('tenant_name', $tenantName ?? '') }}" readonly>
            </div>
            <div class="content-row">
                <label for="payment_month">Month Due Date:</label>
                <select id="payment_month" name="payment_month">
                    @foreach ($rentBills as $bill)
                        <option value="{{ $bill->due_date }}">{{ $bill->due_date }}</option>
                    @endforeach
                </select>
            </div>
            <div class="content-row">
                <label for="landlord_name">Landlord’s Name:</label>
                <input id="landlord_name" name="landlord_name" type="text" value="{{ old('landlord_name', $landlordName ?? '') }}" readonly>
            </div>
            <div class="signature">
                <label for="landlord_signature">Signature of the Landlord:</label>
                <input id="landlord_signature" name="landlord_signature" type="text" value="{{ old('landlord_signature', $landlordName ?? '') }}" readonly>
            </div>
            <button type="submit" style="margin-top: 20px;">Submit Receipt</button>
        </div>
    </form>
</body>
@endsection
