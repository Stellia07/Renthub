@extends('owner.owner_dashboard')

@section('Contract')
    <br><br><br><br>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 5%;
            margin-right: 10%;
        }

        .editable {
            display: inline-block;
            border-bottom: 1px solid #000;
            padding: 2px 5px;
            margin: 0 5px;
            min-width: 150px;
            font-style: italic;
        }

        .editable:focus {
            outline: 2px solid #a5a5a5;
            outline-offset: -2px;
            background-color: #e8e8e8;
        }

        .section {
            margin-bottom: 20px;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        button:disabled {
            cursor: not-allowed;
            opacity: 0.5;
        }
    </style>
    </head>

    <body>
        <form method="POST" action="{{ route('lease.store') }}">
            @csrf
            <h2>Room Rental Agreement</h2>
            <div id="editableAgreement">
                <!-- Revised section with date-only input fields -->
                <div class="section">
                    <p><strong>Parties:</strong> This Room Rental Agreement is made effective as of <input type="date"
                            name="effective_date" required>, by and between <input type="text" name="homeowner_name"
                            placeholder="Homeowner Name" required>, of <input type="text" name="homeowner_address"
                            placeholder="Homeowner Address" required> ("Homeowner"), and <input type="text"
                            name="renter_name" placeholder="Renter Name" required>, of <input type="text"
                            name="renter_address" placeholder="Renter Email Address" required> ("Renter").</p>
                </div>

                <!-- Ensure all date inputs in your form use type="date" for consistency -->
                <div class="section">
                    <p><strong>Premises:</strong> The property to be rented is located at <input type="text"
                            name="room_address" placeholder="Property Address" required> ("Premises").</p>
                </div>

                <div class="section">
                    <p><strong>Rental Term:</strong> The rental term will be on a month-to-month basis commencing on <input
                            type="date" name="start_date" required> and continuing until either party terminates the
                        agreement with <input type="number" name="termination_notice_period"
                            placeholder="Notice Period in Days" required> days' written notice.</p>
                </div>

                <div class="section">
                    <p><strong>Termination:</strong> This Agreement may be terminated by either party with <input
                            type="number" name="termination_non_compliance_period"
                            placeholder="Breach Correction Period in Days" required> days' notice. In the event of a breach
                        of contract, the non-complying party has <input type="number" name="breach_correction_period"
                            placeholder="Breach Correction Period in Days" required> days to remedy the breach.</p>
                </div>

                <div class="section">
                    <p><strong>Entire Agreement:</strong> This document and any attached exhibits constitute the entire
                        agreement between the parties concerning the subject matter and supersede all previous agreements,
                        promises, proposals, representations, understandings, and negotiations, whether written or oral.</p>
                </div>
            </div>

            <!-- Non-functional submit button as per request -->
            <button id="submitAgreement">Submit Agreement</button>
        </form>
    </body>
@endsection
