<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Tenant;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
class ContractController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'receiver_email' => 'required|email',
            'contractFile' => 'required|file',
        ]);

        // Store the contract file
        if ($request->hasFile('contractFile')) {
            $destinationPath = public_path('storage/contracts'); // Target directory
            $file = $request->file('contractFile'); // Uploaded file
            $filename = uniqid() . '_' . $file->getClientOriginalName(); // New filename
            $file->move($destinationPath, $filename); // Move the file
            $filePath = 'contracts/' . $filename; // Save path
        }

        // Save contract data to the database
        $contract = new Contract();
        $contract->sender_email = auth()->user()->email;
        $contract->receiver_email = $request->input('receiver_email');
        $contract->file_path = $filePath;
        $contract->save();

        // Redirect back with contract details
        return redirect()->back()->with('success', 'Contract uploaded successfully.')
                                ->with('contract', $contract);
    }
    public function view($id)
    {
        $contract = Contract::findOrFail($id);

        // Assuming the file is stored as 'contracts/FILENAME' in 'storage/app/public'
        $pathToFile = public_path('storage/' . $contract->file_path);  // Corrected path using public_path()

        if (!File::exists($pathToFile)) {
            abort(404, "The file does not exist.");
        }

        // Serving the file from the public directory
        return response()->file($pathToFile);
    }



    public function showTenants()
{
    $contracts = Contract::all();  // Fetch all contracts from the database
    $tenants = Tenant::with('contracts')->get(); // Assuming you also need tenants
    return view('owner.managetenants.tenant_manager', compact('contracts', 'tenants'));
}

public function download($id)
{
    $contract = Contract::findOrFail($id);
    $pathToFile = public_path('storage/' . $contract->file_path);

    if (!File::exists($pathToFile)) {
        abort(404, 'File not found.');
    }

    return response()->download($pathToFile);
}
public function leaseAgreement()
{
    $contracts = Contract::all(); // Assuming fetching all contracts
    $contract = $contracts->first(); // Example: Get the first contract to use in form

    return view('contracts.lease-agreement', compact('contracts', 'contract'));
}

// ContractController.php
public function update(Request $request)
{
    $userEmail = auth()->user()->email;
    $contract = Contract::where('receiver_email', $userEmail)->firstOrFail();

    $request->validate([
        'contractFile' => 'required|file',
    ]);

    if ($request->hasFile('contractFile')) {
        $file = $request->file('contractFile');
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $destinationPath = 'contracts';  // Relative path within the "storage/app/public" directory

        // Full path for file operations, leveraging the 'public/storage' as the base directory
        $fullPath = public_path('storage/' . $destinationPath);
        if (!File::exists($fullPath)) {
            File::makeDirectory($fullPath, 0755, true);  // Ensure the directory exists
        }

        // Attempt to move the file to the appropriate directory
        try {
            $file->move($fullPath, $filename);

            // Update the contract's file path in the database to be relative to the storage directory
            $contract->file_path = $destinationPath . '/' . $filename;
            $contract->is_uploaded = true; // Set is_uploaded to true
            $contract->save();
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'File upload failed: ' . $e->getMessage()]);
        }
    }

    return redirect()->back()->with('success', 'Contract updated successfully.');
}



}

