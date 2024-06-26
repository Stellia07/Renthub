@extends('owner.owner_dashboard')

@section('owner')
<style>
    .modal-lg {
        max-width: 95% !important;
    }
    .table-responsive {
        overflow-x: auto;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
    .form-label {
        margin-bottom: 0.5rem;
        font-weight: bold;
    }
    .submit-btn {
        padding: 0.5rem 1rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        cursor: pointer;
    }
    .submit-btn:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
    .status-pending {
        background-color: #ffb3b3; /* Light Red */
        color: #000; /* Black text */
    }
    .status-paid {
        background-color: #90ee90; /* Light Green */
        color: #000; /* Black text */
    }
    .status-unpaid {
        background-color: #ffcccb; /* Light Coral */
        color: #000; /* Black text */
    }
</style>

@php
    $isAdmin = Auth::check() && Auth::user()->role === 'owner';
@endphp

<div class="page-content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Property Name</th>
                <th>Property Price</th>
                <th>Tenant Email</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Contract</th>
                <th>Download Contract</th>
                <th>View Contract</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->id }}</td>
                    <td>{{ $tenant->property_name }}</td>
                    <td>{{ $tenant->property_price }}</td>
                    <td>{{ $tenant->tenant_email }}</td>
                    <td>{{ ucfirst($tenant->status) }}</td>
                    <td>{{ $tenant->created_at }}</td>
                    @if ($isAdmin)
                        <td>
                            @if ($tenant->contracts->isEmpty())
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadContractModal{{ $tenant->id }}">
                                    Upload Contract
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary disabled">
                                    Upload Disabled
                                </button>
                            @endif
                            <div class="modal fade" id="uploadContractModal{{ $tenant->id }}" tabindex="-1" aria-labelledby="uploadContractModalLabel{{ $tenant->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="uploadContractModalLabel{{ $tenant->id }}">Upload Contract</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('upload.contract') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="tenant_id" value="{{ $tenant->id }}">
                                                <div class="form-group">
                                                    <label for="sender_email" class="form-label">Sender Email:</label>
                                                    <input type="email" id="sender_email" name="sender_email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="receiver_email" class="form-label">Receiver Email:</label>
                                                    <input type="email" id="receiver_email" name="receiver_email" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="contractFile" class="form-label">Contract File:</label>
                                                    <input type="file" id="contractFile" name="contractFile" class="form-control" required>
                                                </div>
                                                <div class="alert alert-info" role="alert">
                                                    <h4 class="alert-heading">Contract Data Preview:</h4>
                                                    <p><strong>Sender Email:</strong> {{ Auth::user()->email }}</p>
                                                    <p><strong>Receiver Email:</strong> <span id="receiverEmailPreview{{ $tenant->id }}"></span></p>
                                                    <p><strong>Contract File:</strong> <span id="contractFilePreview{{ $tenant->id }}"></span></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="submit-btn btn btn-primary">Upload Contract</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach ($tenant->contracts as $contract)
                                <a href="{{ route('contracts.download', $contract->id) }}" class="btn btn-primary">Download</a>
                            @endforeach
                        </td>
                        <td>
                            @if ($tenant->contracts && $tenant->contracts->count() > 0)
                                @foreach ($tenant->contracts as $contract)
                                    <a href="{{ route('contracts.view', $contract->id) }}" class="btn btn-info">View Contract</a>
                                @endforeach
                            @else
                                <td>No Contracts Available</td>
                            @endif
                        </td>
                    @endif
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#tenantDetailsModal{{ $tenant->id }}">Bills</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @foreach ($tenants as $tenant)
        <div class="modal fade" id="tenantDetailsModal{{ $tenant->id }}" tabindex="-1" aria-labelledby="tenantDetailsModalLabel{{ $tenant->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tenantDetailsModalLabel{{ $tenant->id }}">Tenant Payment Details - {{ $tenant->tenant_email }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $bills = \App\Models\RentBill::where('tenant_email', $tenant->tenant_email)->get();
                        @endphp

                        <div class="form-group">
                            <label for="filterStatus{{ $tenant->id }}" class="form-label">Filter by Status:</label>
                            <select id="filterStatus{{ $tenant->id }}" class="form-control">
                                <option value="">All</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <table class="table" id="billsTable{{ $tenant->id }}">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Owner Name</th>
                                    <th>Monthly Rent</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                    <tr id="billRow_{{ $bill->id }}" class="bill-row status-{{ $bill->status }}">
                                        <td>{{ $bill->id }}</td>
                                        <td>{{ $bill->owner_name }}</td>
                                        <td>₱{{ $bill->monthly_rent }}</td>
                                        <td>{{ $bill->due_date }}</td>
                                        <td>{{ ucfirst($bill->status) }}</td>
                                        <td>{{ $bill->created_at }}</td>
                                        <td>
                                            @if ($bill->status == 'paid' && $bill->receipt_id)
                                                <a href="{{ route('receipt.view', $bill->receipt_id) }}" class="btn btn-success">Receipt</a>
                                            @else
                                                <button type="button" class="btn btn-warning" disabled>No Receipt Yet</button>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach ($tenants as $tenant)
        document.getElementById('receiver_email{{ $tenant->id }}').addEventListener('change', function() {
            document.getElementById('receiverEmailPreview{{ $tenant->id }}').textContent = this.value;
        });

        document.getElementById('contractFile{{ $tenant->id }}').addEventListener('change', function() {
            var fileName = this.files.length > 0 ? this.files[0].name : 'No file selected';
            document.getElementById('contractFilePreview{{ $tenant->id }}').textContent = fileName;
        });

        document.getElementById('filterStatus{{ $tenant->id }}').addEventListener('change', function() {
            filterBills({{ $tenant->id }});
        });
    @endforeach

    function filterBills(tenantId) {
        const filterStatus = document.getElementById('filterStatus' + tenantId).value;
        const rows = document.querySelectorAll('#billsTable' + tenantId + ' .bill-row');

        rows.forEach(row => {
            if (filterStatus === '' || row.classList.contains('status-' + filterStatus)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});
</script>
@endsection
