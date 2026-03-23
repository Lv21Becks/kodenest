<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['student', 'invoice.course'])->latest();

        // Filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'total_received' => Payment::where('status', 'verified')->sum('amount'),
            'pending_approval' => Payment::where('status', 'pending')->count(),
            'outstanding' => Invoice::whereIn('status', ['unpaid', 'partial'])->sum('balance'),
        ];

        return view('admin.payments.index', compact('payments', 'stats'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['student', 'invoice.course', 'verifiedBy']);
        return view('admin.payments.show', compact('payment'));
    }

    public function verify(Request $request, Payment $payment)
    {
        if ($payment->status === 'verified') {
            return back()->with('error', 'This payment has already been verified.');
        }

        $payment->update([
            'status' => 'verified',
            'verified_by' => auth()->id(),
            'paid_at' => now(),
            'notes' => $request->notes ?? $payment->notes,
        ]);

        // Update Invoice
        $invoice = $payment->invoice;
        $invoice->amount_paid += $payment->amount;
        $invoice->balance = max(0, $invoice->total_amount - $invoice->amount_paid);
        
        if ($invoice->balance <= 0) {
            $invoice->status = 'paid';
        } else {
            $invoice->status = 'partial';
        }
        $invoice->save();

        return back()->with('success', 'Payment verified and invoice updated.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->status === 'verified') {
            return back()->with('error', 'Verified payments cannot be deleted.');
        }
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment record deleted.');
    }
}
