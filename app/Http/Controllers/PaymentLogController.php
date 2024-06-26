<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentLog; // Assuming you have a PaymentLog model
use Illuminate\Support\Facades\Auth;
use App\Models\RentBill;

class PaymentLogController extends Controller
{
    public function create()
    {
        $userEmail = auth()->user()->email; // Get the currently logged-in user's email
        $paymentLogs = PaymentLog::all(); // Fetch all payment logs
        $userPaymentLogs = PaymentLog::where('recipient_email', $userEmail)->get(); // Fetch logs specific to the user

        return view('payment-log.create', compact('paymentLogs', 'userPaymentLogs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'receipt_image_path' => 'required|image',
            'recipient_email' => 'required|email',
            'sender_email' => 'required|email',
            'payment_month' => 'required|string', // validate the payment month
        ]);

        $paymentLog = new PaymentLog;
        $paymentLog->user_id = auth()->id(); // assuming the user is logged in
        $paymentLog->amount = $request->amount;
        $paymentLog->recipient_email = $request->recipient_email;
        $paymentLog->sender_email = $request->sender_email;
        $paymentLog->description = $request->payment_month; // save the selected payment month

        if ($request->hasFile('receipt_image_path')) {
            $destinationPath = public_path('storage/receipts'); // Target directory
            $file = $request->file('receipt_image_path'); // Uploaded file
            $filename = uniqid() . '_' . $file->getClientOriginalName(); // New filename
            $file->move($destinationPath, $filename); // Move the file
            $paymentLog->receipt_image_path = 'receipts/' . $filename; // Save path
        }

        $paymentLog->save();

        return view('tenant.pay'); // redirect to the form or another appropriate route
    }


    public function paymentLogs(Request $request)
    {
        $userEmail = auth()->user()->email;

        // Start with a base query
        $query = PaymentLog::query()->where('recipient_email', $userEmail);

        // Apply date filtering if both startDate and endDate are provided
        if ($request->has(['startDate', 'endDate'])) {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');

            // Filter the payment logs between the start and end dates
            $query->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }

        // Get the filtered or unfiltered payment logs for the user
        $userPaymentLogs = $query->get();

        // Get the highlight parameter from the request
        $highlight = $request->input('highlight', null); // Default to null if not present

        return view('owner.managetenants.payment_logs', compact('userPaymentLogs', 'highlight'));
    }


    public function createPay()
    {
        // Logic to display the payment form
        return view('tenant.pay');
    }

    public function viewPaymentLogs()
    {
        // Get the email of the currently logged-in user
        $userEmail = Auth::user()->email;

        // Retrieve all payment logs where the sender_email matches the logged-in user's email
        $myPaymentLogs = PaymentLog::where('sender_email', $userEmail)->get();

        // Pass the retrieved logs to the view
        return view('tenant.view_payment_logs', compact('myPaymentLogs'));
    }
}
