<?php

// app/Http/Controllers/LeaseController.php

namespace App\Http\Controllers;

use App\Models\LeaseAgreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LeaseController extends Controller
{
    public function create()
    {
        return view('lease-form');
    }
    public function leaseAgreementForm()
    {
        return view('lease_agreement_form'); // The name of your Blade file
    }
    public function store(Request $request)
    {
        \Log::info('Form data:', $request->all());
        $validatedData = $request->validate([
            'homeowner_name' => 'required|string',
            'homeowner_address' => 'required|string',
            'renter_name' => 'required|string',
            'renter_address' => 'required|string',
            'room_address' => 'required|string',
            'start_date' => 'required|date',
            // Assuming effective_date is the start or a significant date for the agreement
            'effective_date' => 'required|date',
            // Add validation for other fields present in the form submission
            'termination_notice_period' => 'required|numeric',
            'termination_non_compliance_period' => 'required|numeric',
            'breach_correction_period' => 'required|numeric',
        ]);

        // Set default values for the checkboxes if they are not present in the request
        $validatedData['lessor_signed'] = $request->has('lessor_signed') ? true : false; // Default to false if not checked
        $validatedData['lessee_signed'] = $request->has('lessee_signed') ? true : false; // Default to false if not checked

        // Create the LeaseAgreement instance and fill with validated data
        $leaseAgreement = new LeaseAgreement($validatedData);
        $leaseAgreement->save();

        // Pass the validatedData only to the tenant_manager view
        return view('lease-agreement', ['data' => $leaseAgreement]);
    }


    public function viewContract($email)
    {
        // Hypothetical method to retrieve data based on email
        // This could be a query to your database to get the relevant information
        $data = LeaseAgreement::where('lessee_email', $email)->first();

        // Check if data was successfully retrieved
        if ($data) {
            // Data found, pass it to the view
            return view('lease-agreement', compact('data'));
        } else {
            // No data found, redirect back with an error message
            return back()->withErrors(['message' => 'Data not found for the provided email.']);
        }
    }
    public function myLeaseAgreement()
    {
        $userEmail = Auth::user()->email;
        // Assuming the lease agreement's lessee_email or lessee_name column stores the email
        $leaseAgreementData = LeaseAgreement::where('tenant_email', $userEmail)->firstOrFail();

        return view('lease-agreement-tenant', ['data' => $leaseAgreementData]);
    }
    public function showByRenterAddress($renterAddress)
    {
        // Replace spaces with plus signs in URL, if necessary
        $renterAddress = str_replace('+', ' ', $renterAddress);

        // Fetch the lease agreement by renter address
        $leaseAgreement = LeaseAgreement::where('renter_address', $renterAddress)->firstOrFail();

        // Pass the lease agreement data to the view
        return view('lease-agreement', ['data' => $leaseAgreement]);
    }
}
