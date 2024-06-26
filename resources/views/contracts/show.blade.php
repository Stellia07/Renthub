<div class="container">
    <h1>Contracts</h1>
    @if($contracts->isEmpty())
        <p>No contracts found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Sender Email</th>
                    <th>Receiver Email</th>
                    <th>Contract File Path</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                    <tr>
                        <td>{{ $contract->sender_email }}</td>
                        <td>{{ $contract->receiver_email }}</td>
                        <td><a href="{{ asset('storage/' . $contract->file_path) }}" target="_blank">View File</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
