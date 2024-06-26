<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receipt;
use App\Models\PaymentLog;
use App\Models\tenant;
use App\Models\User;
use App\Models\RentBill;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class RentReceiptController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rent_receipt');
    }

    public function show($receiptId)
    {
        // Find the receipt by its ID
        $receipt = Receipt::findOrFail($receiptId);

        // Pass the receipt data to the view
        return view('receipts.view', ['receipt' => $receipt]);
    }

    public function createWithLogId($logId)
    {
        $paymentLog = PaymentLog::findOrFail($logId);
        $currentDate = Carbon::now()->toDateString();

        // Find the tenant name based on sender_email
        $tenantUser = User::where('email', $paymentLog->sender_email)->first();
        $tenantName = $tenantUser ? $tenantUser->name : 'Tenant Name Not Found';

        // Find the landlord name based on recipient_email
        $landlordUser = User::where('email', $paymentLog->recipient_email)->first();
        $landlordName = $landlordUser ? $landlordUser->name : 'Landlord Name Not Found';



        // Additional data fetching as before
        $tenant = Tenant::where('tenant_email', $paymentLog->sender_email)
            ->where('owner_email', $paymentLog->recipient_email)
            ->first();
        $propertyAddress = $tenant ? $tenant->property_name : 'Property Not Found';

        // Passing the necessary data to the view
        return view('rent_receipt', [
            'receiptNumber' => $paymentLog->id,
            'dateOfPayment' => $currentDate,
            'amountPaid' => $paymentLog->amount,
            'propertyAddress' => $propertyAddress,
            'tenantName' => $tenantName,
            'landlordName' => $landlordName,
        ]);
    }
    // In RentReceiptController
//Missing
public function viewWithLogId($id)
{
    // Check if the ID corresponds to a Receipt
    $receipt = Receipt::find($id);

    if ($receipt) {
        // If a receipt is found, use its data
        $data = [
            'receiptNumber' => $receipt->receipt_number,
            'dateOfPayment' => $receipt->date_of_payment,
            'amountPaid' => $receipt->amount_paid,
            'propertyAddress' => $receipt->property_address,
            'tenantName' => $receipt->tenant_name,
            'landlordName' => $receipt->landlord_name,
        ];
    } else {
        // If no receipt is found, check for a PaymentLog
        $paymentLog = PaymentLog::findOrFail($id);
        $currentDate = Carbon::now()->toDateString();
        $userEmail = Auth::user()->email;

        // Reuse your existing logic for finding tenant and landlord names, and property address
        $tenantUser = User::where('email', $paymentLog->sender_email)->first();
        $tenantName = $tenantUser ? $tenantUser->name : 'Tenant Name Not Found';

        $landlordUser = User::where('email', $paymentLog->recipient_email)->first();
        $landlordName = $landlordUser ? $landlordUser->name : 'Landlord Name Not Found';

        $tenant = Tenant::where('tenant_email', $paymentLog->sender_email)
                        ->where('owner_email', $paymentLog->recipient_email)
                        ->first();
        $propertyAddress = $tenant ? $tenant->property_name : 'Property Not Found';

        $data = [
            'receiptNumber' => $paymentLog->id,
            'dateOfPayment' => $currentDate,
            'amountPaid' => $paymentLog->amount,
            'propertyAddress' => $propertyAddress,
            'tenantName' => $tenantName,
            'landlordName' => $landlordName,
        ];
    }

    $userEmail = Auth::user()->email;
    $myPaymentLogs = PaymentLog::where('sender_email', $userEmail)->get();

    // Return the view for viewing, not editing or creating
    return view('tenant.receipt', $data, compact('myPaymentLogs'));
}





    public function store(Request $request)
{
    \Log::info('Store method called with request data: ', $request->all());

    // Validation
    $validated = $request->validate([
        'date_of_payment' => 'required|date',
        'receipt_number' => 'required|string|max:255',
        'amount_paid' => 'required|numeric',
        'property_address' => 'required|string|max:255',
        'tenant_name' => 'required|string|max:255',
        'payment_month' => 'required|string|max:255',
        'landlord_name' => 'required|string|max:255',
    ]);

    // Create the receipt
    $receipt = Receipt::create($validated);
    \Log::info('Receipt created: ', $receipt->toArray());

    // Update the rent_bills table
    $tenant = User::where('name', $request->tenant_name)->first();
    \Log::info('Tenant found: ', $tenant ? $tenant->toArray() : ['Tenant not found']);

    if ($tenant) {
        $dueDate = Carbon::parse($request->payment_month)->format('Y-m-d');
        \Log::info('Parsed due date: ' . $dueDate);

        $rentBill = RentBill::where('tenant_email', $tenant->email)
            ->where('due_date', $dueDate)
            ->whereNull('receipt_id')
            ->first();

        \Log::info('Found Rent Bill: ', $rentBill ? $rentBill->toArray() : ['Rent Bill not found']);

        // Update rent bill and receipt
        if ($rentBill) {
            $rentBill->update([
                'payment_date' => now(),
                'payment_month' => $dueDate,
                'receipt_id' => $receipt->id,
                'status' => 'paid', // Always set to 'paid'
            ]);

            // Update the assigned column in the receipt with the payment month
            $receipt->update([
                'assigned' => $dueDate
            ]);

            \Log::info('Rent Bill updated with receipt ID: ' . $receipt->id);
        }
    }

    // Update the payment_logs table
    $paymentLogs = PaymentLog::where('sender_email', $tenant->email)
        ->where('description', $request->payment_month)
        ->get();

    \Log::info('Payment Logs found: ', ['count' => $paymentLogs->count()]);

    foreach ($paymentLogs as $paymentLog) {
        $paymentLog->update([
            'assigned' => $receipt->id,
        ]);

        \Log::info('Payment Log updated with receipt ID: ' . $receipt->id);
    }

    return redirect()->route('owner.payment.logs')->with('success', 'Receipt saved successfully and rent bill updated!');
}

//Owner View Receipt
public function viewReceipt($id)
{
    // Fetch receipt data using the id
    $receipt = Receipt::find($id);

    // Check if receipt exists
    if (!$receipt) {
        return redirect()->back()->with('error', 'Receipt not found.');
    }

    // Pass the receipt data to the view
    return view('rent_receipt_view', [
        'dateOfPayment' => $receipt->date_of_payment,
        'receiptNumber' => $receipt->receipt_number,
        'amountPaid' => $receipt->amount_paid,
        'propertyAddress' => $receipt->property_address,
        'tenantName' => $receipt->tenant_name,
        'landlordName' => $receipt->landlord_name,
    ]);
}

// TEnant View Receipt
public function viewReceiptByLogId($logId)
    {
        Log::info('viewReceiptByLogId called with Log ID', ['logId' => $logId]);

        $paymentLog = PaymentLog::findOrFail($logId);
        $currentDate = Carbon::now()->toDateString();

        // Reuse your existing logic for finding tenant and landlord names, and property address
        $tenantUser = User::where('email', $paymentLog->sender_email)->first();
        $tenantName = $tenantUser ? $tenantUser->name : 'Tenant Name Not Found';

        $landlordUser = User::where('email', $paymentLog->recipient_email)->first();
        $landlordName = $landlordUser ? $landlordUser->name : 'Landlord Name Not Found';

        $tenant = Tenant::where('tenant_email', $paymentLog->sender_email)
            ->where('owner_email', $paymentLog->recipient_email)
            ->first();
        $propertyAddress = $tenant ? $tenant->property_name : 'Property Not Found';

        Log::info('Payment log processed', [
            'logId' => $logId,
            'tenantName' => $tenantName,
            'landlordName' => $landlordName,
            'propertyAddress' => $propertyAddress,
            'amountPaid' => $paymentLog->amount,
            'dateOfPayment' => $currentDate,
        ]);

        // Return the view for viewing, not editing or creating
        return view('rent_receipt_view', [
            'receiptNumber' => $paymentLog->id,
            'dateOfPayment' => $currentDate,
            'amountPaid' => $paymentLog->amount,
            'propertyAddress' => $propertyAddress,
            'tenantName' => $tenantName,
            'landlordName' => $landlordName,
        ]);
    }
}
