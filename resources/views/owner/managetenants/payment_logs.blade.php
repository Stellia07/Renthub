@extends('owner.owner_dashboard')

@section('owner')
<div class="page-content">
    <h2>My Payment Logs</h2>
    <form action="{{ url()->current() }}" method="GET">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <label class="sr-only" for="startDate">Start Date</label>
                <input type="date" class="form-control mb-2" id="startDate" name="startDate" placeholder="Start Date">
            </div>
            <div class="col-auto">
                <label class="sr-only" for="endDate">End Date</label>
                <input type="date" class="form-control mb-2" id="endDate" name="endDate" placeholder="End Date">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-2">Filter</button>
            </div>
        </div>
    </form>
    @if ($userPaymentLogs->isEmpty())
        <p>No payment logs found for you.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Amount</th>
                        <th>Recipient Email</th>
                        <th>Sender Email</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Receipt Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userPaymentLogs as $log)
                        <tr id="log_{{ $log->id }}" class="{{ isset($highlight) && $highlight == $log->id ? 'table-warning' : '' }}">
                            <td>{{ $log->amount }}</td>
                            <td>{{ $log->recipient_email }}</td>
                            <td>{{ $log->sender_email }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if ($log->receipt_image_path)
                                    <button class="btn btn-primary btn-sm" onclick="window.open('{{ asset('storage/' . $log->receipt_image_path) }}')">View Image</button>
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @if ($log->receiptExists)
                                    <a href="{{ route('receipt.view-by-log', $log->id) }}" class="btn btn-success">Receipt</a>
                                @else
                                    <a href="{{ route('rent-receipt-with-log', $log->id) }}" class="btn btn-primary">Create Rent Receipt</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
