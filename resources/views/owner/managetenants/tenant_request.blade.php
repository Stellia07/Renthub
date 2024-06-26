@extends('owner.owner_dashboard')

@section('owner')
<head>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<div class="page-content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Property Name</th>
                <th>Property Price</th>
                <th>Owner Name</th>
                <th>Owner Email</th>
                <th>Tenant Email</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->id }}</td>
                    <td>{{ $tenant->property_name }}</td>
                    <td>{{ $tenant->property_price }}</td>
                    <td>{{ $tenant->owner_name }}</td>
                    <td>{{ $tenant->owner_email }}</td>
                    <td>{{ $tenant->tenant_email }}</td>
                    <td>{{ ucfirst($tenant->status) }}</td>
                    <td>{{ $tenant->created_at }}</td>
                    <td>{{ $tenant->updated_at }}</td>
                    <td>
                        @if ($tenant->status == 'pending')
                            <div style="display: flex; justify-content: start; gap: 10px;">
                                <!-- Accept Button -->
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#acceptModal" data-tenant="{{ $tenant->id }}">
                                    Accept
                                </button>

                                <!-- Reject Button -->
                                <form method="POST" action="{{ route('tenant.reject', $tenant) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Accept Modal -->
<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('tenant.accept', ['tenant' => 0]) }}" id="acceptForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptModalLabel">Accept Tenant</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="duration">Select Duration (months)</label>
                        <select class="form-control" id="duration" name="duration">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ $i }} month(s)</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#acceptModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var tenantId = button.data('tenant');
        var form = $('#acceptForm');
        var action = "{{ route('tenant.accept', ['tenant' => ':id']) }}";
        form.attr('action', action.replace(':id', tenantId));
    });
</script>
@endsection
