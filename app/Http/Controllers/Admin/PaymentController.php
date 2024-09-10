<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('code', 'like', '%' . $search . '%');
        }

        $perPage = $request->input('perPage', session('perPage', 5));
        session(['perPage' => $perPage]);

        // Thêm lệnh sắp xếp theo mã tăng dần
        $query->orderBy('code', 'asc');

        $payments = $query->paginate($perPage);

        return view('admin.payments.index', compact('payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:payments,code',
            'description' => 'nullable|string',
        ]);

        $payment = new Payment();
        $payment->id = (string) Str::uuid();
        $payment->name = $request->input('name');
        $payment->code = $request->input('code');
        $payment->description = $request->input('description');

        $payment->save();

        return redirect()->route('admin.payments.index')->with('msg', 'Loại thanh toán đã được thêm thành công.');
    }

    public function update(Request $request, Payment $payment)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:payments,code,' . $payment->id,
            'description' => 'nullable|string',
        ]);

        // Update the Payment with the validated data
        $payment->name = $request->input('name');
        $payment->code = $request->input('code');
        $payment->description = $request->input('description');

        $payment->save();

        // Redirect back to the Payments index with a success message
        return redirect()->route('admin.payments.index')->with('msg', 'Loại thanh toán đã được cập nhật thành công.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('msg', 'Loại thanh toán đã được xóa thành công.');
    }
}
