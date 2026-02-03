<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Vendor;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\DisplaySize;
use App\Models\DisplayType;
use App\Models\Generation;
use App\Models\Graphic;
use App\Models\ProductStock;
use App\Models\GroupProduct;
use App\Models\HDD;
use App\Models\InvoicePayment;
use App\Models\OperatingSystem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Unit;
use App\Models\Processor;
use App\Models\ProcessorModel;
use App\Models\ProductInvoice;
use App\Models\ProductReturn;
use App\Models\ProductSerialNumber;
use App\Models\RamSize;
use App\Models\RamType;
use App\Models\SpecialFeature;
use App\Models\SSD;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use NumberToWords\NumberToWords;
use PDF;
use Str;
use Illuminate\Support\Facades\Auth;

class ProductInvoiceController extends Controller
{
    // public function allInvoice()
    // {
    //     $invoices = ProductInvoice::with(['product', 'customer'])->latest()->paginate(10);
    //     return view('backend.product_invoice.all_invoice', compact('invoices'));
    // }

    // public function invoiceCreate()
    // {
    //     $customers = User::where('role', 3)->latest()->get();
    //     $products = Product::where('stock_qty', '>', 0)->where('is_stock', 1)->latest()->get();
    //     $invoiceNo = mt_rand(1000000, 9999999);

    //     return view('backend.product_invoice.create_invoice', compact('customers', 'products', 'invoiceNo'));
    // }

    public function allInvoice()
{
    $user = Auth::guard('admin')->user();

    // Super admin can always access
    if ($user->role == '1') {
        $invoices = ProductInvoice::with(['product', 'customer'])->latest()->paginate(50);
        return view('backend.product_invoice.all_invoice', compact('invoices'));
    }

    // Staff (role 5) → Check if permission 65 (Invoice View) exists
    if ($user->role == '5') {
        $permissions = json_decode($user->staff->role->permissions ?? '[]', true);

        // Normalize permission data (handle string/integer)
        $permissions = array_map('strval', $permissions);

        if (in_array('65', $permissions)) {
            $invoices = ProductInvoice::with(['product', 'customer'])->latest()->paginate(10);
            return view('backend.product_invoice.all_invoice', compact('invoices'));
        } else {
            notify()->error('You do not have permission to view invoices.');
            return redirect()->back();
        }
    }

    abort(403, 'Unauthorized Access');
}


public function invoiceCreate()
{
    $user = Auth::guard('admin')->user();

    // Super admin can always access
    if ($user->role == '1') {
        $customers = User::where('role', 3)->latest()->get();
        $products = Product::where('stock_qty', '>', 0)->where('is_stock', 1)->latest()->get();
        $invoiceNo = mt_rand(1000000, 9999999);

        return view('backend.product_invoice.create_invoice', compact('customers', 'products', 'invoiceNo'));
    }

    // Staff (role 5) → Check if permission 63 (Invoice Create) exists
    if ($user->role == '5') {
        $permissions = json_decode($user->staff->role->permissions ?? '[]', true);
        $permissions = array_map('strval', $permissions);

        if (in_array('63', $permissions)) {
            $customers = User::where('role', 3)->latest()->get();
            $products = Product::where('stock_qty', '>', 0)->where('is_stock', 1)->latest()->get();
            $invoiceNo = mt_rand(1000000, 9999999);

            return view('backend.product_invoice.create_invoice', compact('customers', 'products', 'invoiceNo'));
        } else {
            notify()->error('You do not have permission to create invoices.');
            return redirect()->back();
        }
    }

    abort(403, 'Unauthorized Access');
}

    public function getCustomer($id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'id'      => $customer->id,
            'name'    => $customer->name,
            'phone'   => $customer->phone,
            'email'   => $customer->email,
            'address' => $customer->address,
        ]);
    }

    public function getProductDetails($id)
    {
        $product = Product::with(['serialNumbers' => function ($q) {
            $q->where('is_sold', false); // only available serials
        }])->findOrFail($id);

        return response()->json([
            'product_code'   => $product->product_code,
            'regular_price'  => $product->regular_price,
            'discount_price' => $product->discount_price,
            'serial_numbers' => $product->serialNumbers->pluck('serial_number'), // return array of strings
        ]);
    }

    public function invoiceStore(Request $request)
    {

        // Validate the request
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'user_id' => 'nullable',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email|max:255',
            'customer_phone' => 'required|string|max:255',
            'customer_address' => 'nullable|string|max:255',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|numeric|min:1',
            'product_code.*' => 'nullable|string',
            'regular_price.*' => 'required|numeric|min:0',
            'discount_price.*' => 'nullable|numeric|min:0',
            'tax.*' => 'nullable|numeric|min:0',
            'total_price.*' => 'required|numeric|min:0',
            'paid_amount.*' => 'nullable|numeric|min:0',
            'due_amount.*' => 'nullable|numeric|min:0',
            'due_date.*' => 'nullable|date',
            'shipping_cost.*' => 'nullable|numeric|min:0',
            'cod_cost.*' => 'nullable|numeric|min:0',
            'payment_status.*' => 'required|in:paid,unpaid,partial',
            'payment_methods.*' => 'nullable|in:cash,credit_card,bank,bkash,nagad',
            'amount.*' => 'nullable|numeric|min:0',
            'serial_number.*' => 'nullable|string',
            'warranty.*' => 'nullable|string',
        ]);

        try {
            // Begin a database transaction
            DB::beginTransaction();

            // Insert or get user
            $user = null;
            $email = $request->customer_email;

            //Auto-generate email if not given
            if (!$email && $request->customer_name) {
                $baseEmail = Str::slug($request->customer_name, '.');
                $email = $baseEmail . '@gmail.com';
            }
            if ($email) {
                $user = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $request->customer_name,
                        'phone' => $request->customer_phone,
                        'address' => $request->customer_address,
                        'password' => Hash::make("12345678"), // temporary password
                        'role' => 3, // default user role
                        'status' => 1
                    ]
                );
            } elseif ($request->customer_phone) {
                $user = User::firstOrCreate(
                    ['phone' => $request->customer_phone],
                    [
                        'name' => $request->customer_name,
                        'email' => $email ?? null,
                        'address' => $request->customer_address,
                        'password' => Hash::make("12345678"), // temporary password
                        'role' => 3, // default user role
                        'status' => 1
                    ]
                );
            }

            //Create Order (only once per invoice)
            $order = Order::create([
                'user_id'       => $user->id ?? $request->user_id,
                'invoice_no'  => $request->invoice_no,
                'order_type'  => 2,
                'name' => $request->customer_name,
                'email' => $email,
                'phone' => $request->customer_phone,
                'address' => $request->customer_address,
                'grand_total'  => collect($request->total_price)->sum(),
                'paid_amount'   => collect($request->paid_amount)->sum(),
                'delivery_status'        => 'delivered', // or "paid" depending on logic
                'payment_status'        => 1,
                'delivered_date'        => now(),
            ]);

            // Loop through the products to create invoices
            foreach ($request->product_id as $index => $productId) {
                $product = Product::findOrFail($productId);

                // Create the product invoice
                $invoice = ProductInvoice::create([
                    'invoice_no' => $request->invoice_no,
                    'user_id' => $request->user_id,
                    'name' => $request->customer_name,
                    'email' => $email,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'product_id' => $productId,
                    'quantity'   => $request->quantity[$index] ?? 1,
                    'product_code'   => $request->product_code[$index] ?? null,
                    'serial_number' => $request->serial_number[$index] ?? null,
                    'warrenty' => $request->warranty[$index] ?? null,
                    'regular_price' => $request->regular_price[$index],
                    'discount_price' => $request->discount_price[$index] ?? null,
                    'tax' => $request->tax[$index] ?? 0,
                    'total_price' => $request->total_price[$index],
                    'paid_amount' => $request->paid_amount[$index] ?? 0,
                    'due_amount' => $request->due_amount[$index] ?? 0,
                    'due_date' => $request->due_date[$index] ?? now(),
                    'shipping_cost' => $request->shipping_cost[$index] ?? 0,
                    'cod_cost' => $request->cod_cost[$index] ?? 0,
                    'payment_status' => $request->payment_status[$index] ?? null,
                ]);

                // Create the invoice payment
                InvoicePayment::create([
                    'invoice_id' => $invoice->id,
                    'invoice_no' => $request->invoice_no,
                    'product_code' => $request->product_code[$index] ?? null,
                    'payment_method' => $request->payment_methods[$index] ?? null,
                    'amount' => $request->amount[$index] ?? 0,
                    'payment_date' => now(),
                ]);

                // Find serial number ID if provided
                $serialId = null;
                if (!empty($request->serial_number[$index])) {
                    $serial = ProductSerialNumber::where('serial_number', $request->serial_number[$index])->first();
                    if ($serial) {
                        $serialId = $serial->id;
                        $serial->update(['is_sold' => true]);
                    }
                }

                // Create OrderDetail
                OrderDetail::create([
                    'order_id'                => $order->id,
                    'invoice_no'              => $request->invoice_no,
                    'product_id'              => $productId,
                    'product_serial_number_id' => $serialId,
                    'product_name'            => $product->name_en,
                    'qty'                     => $request->quantity[$index] ?? 1,
                    'price'                   => $request->regular_price[$index] - $request->discount_price[$index],
                ]);

                // Update stock
                $product->stock_qty = $product->stock_qty - $request->quantity[$index];
                $product->save();
            }


            // Commit the transaction
            DB::commit();

            return redirect()->route('product.all.invoice')->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create invoice: ' . $e->getMessage())->withInput();
        }
    }

    public function unexistingProductInvoiceCreate()
    {
        $customers = User::where('role', 3)->latest()->get();
        $invoiceNo = mt_rand(1000000, 9999999);

        return view('backend.product_invoice.create_unexisting_product_invoice', compact('customers', 'invoiceNo'));
    }

    public function unexistingProductInvoiceStore(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'product_name.*' => 'required|string',
            'quantity.*' => 'required|integer|min:1',
            'product_description.*' => 'nullable|string',
            'product_code.*' => 'nullable|string',
            'regular_price.*' => 'required|numeric|min:0',
            'discount_price.*' => 'nullable|numeric|min:0',
            'tax.*' => 'nullable|numeric|min:0',
            'total_price.*' => 'required|numeric|min:0',
            'paid_amount.*' => 'nullable|numeric|min:0',
            'due_amount.*' => 'nullable|numeric|min:0',
            'due_date.*' => 'nullable|date',
            'shipping_cost.*' => 'nullable|numeric|min:0',
            'payment_status.*' => 'required|in:paid,unpaid,partial',
            'payment_methods.*' => 'required|in:cash,credit_card,bank,bkash,nagad',
            'amount.*' => 'required|numeric|min:0',
            'serial_number.*' => 'nullable|string',
            'warrenty.*' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Loop through products
            foreach ($request->regular_price as $index => $price) {
                $invoice = ProductInvoice::create([
                    'invoice_no'     => $request->invoice_no,
                    'user_id'        => $request->user_id,
                    'product_name'   => $request->product_name[$index] ?? null,
                    'quantity'      => $request->quantity[$index] ?? 1,
                    'product_description'   => $request->product_description[$index] ?? null,
                    'product_code'   => $request->product_code[$index] ?? null,
                    'serial_number'  => $request->serial_number[$index] ?? null,
                    'warrenty'       => $request->warrenty[$index] ?? null,
                    'regular_price'  => $request->regular_price[$index] ?? 0,
                    'discount_price' => $request->discount_price[$index] ?? 0,
                    'tax'            => $request->tax[$index] ?? 0,
                    'total_price'    => $request->total_price[$index] ?? 0,
                    'paid_amount'    => $request->paid_amount[$index] ?? 0,
                    'due_amount'     => $request->due_amount[$index] ?? 0,
                    'due_date'       => $request->due_date[$index] ?? null,
                    'shipping_cost'  => $request->shipping_cost[$index] ?? 0,
                    'payment_status' => $request->payment_status[$index] ?? 'unpaid',
                ]);

                // Create matching payment record
                InvoicePayment::create([
                    'invoice_id'     => $invoice->id,
                    'invoice_no'     => $request->invoice_no,
                    'product_code'   => $request->product_code[$index] ?? null, // optional
                    'payment_method' => $request->payment_methods[$index],
                    'amount'         => $request->amount[$index] ?? 0,
                    'payment_date'   => now(),
                ]);
            }

            DB::commit();
            return redirect()->route('product.all.invoice')->with('success', 'Invoice created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create invoice: ' . $e->getMessage())->withInput();
        }
    }

    public function productInvoiceShow($invoice_no)
    {

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');

        // Fetch all products under the same invoice_no with customer and payment info
        $invoices = ProductInvoice::with(['customer', 'payments'])
            ->where('invoice_no', $invoice_no)
            ->get();

        if ($invoices->isEmpty()) {
            abort(404, 'Invoice not found.');
        }

        // All invoices under same invoice_no have same customer, so take first one
        $customer = $invoices->first()->customer;

        // Merge all payments for this invoice_no
        $payments = $invoices->flatMap->payments;

        $total = $invoices->sum('total_price');
        $paid = $invoices->sum('paid_amount');
        $due = $invoices->sum('due_amount');
        $shipping = $invoices->sum('shipping_cost');
        $cod = $invoices->sum('cod_cost');
        $totalQuantity = $invoices->sum('quantity');

        $netPayable = $total;
        $totalDue = $netPayable - $paid;

        $netPayInWords = ucfirst($numberTransformer->toWords(floor($netPayable))) . ' only.';

        return view('backend.product_invoice.product_invoice_show', compact('invoices', 'customer', 'payments', 'total', 'paid', 'due', 'totalDue', 'shipping', 'cod', 'totalQuantity', 'netPayInWords'));
    }

    public function generateInvoicePdf($invoice_no)
    {
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');

        $invoices = ProductInvoice::with(['customer', 'payments'])
            ->where('invoice_no', $invoice_no)
            ->get();

        if ($invoices->isEmpty()) {
            abort(404, 'Invoice not found.');
        }

        $customer = $invoices->first()->customer;
        $payments = $invoices->flatMap->payments;

        $total = $invoices->sum('total_price');
        $paid = $invoices->sum('paid_amount');
        $due = $invoices->sum('due_amount');
        $shipping = $invoices->sum('shipping_cost');
        $cod = $invoices->sum('cod_cost');
        $totalQuantity = $invoices->sum('quantity');

        $netPayable = $total;
        $totalDue = $netPayable - $paid;

        $netPayInWords = ucfirst($numberTransformer->toWords(floor($netPayable))) . ' only.';

        //Collect all product serial numbers (filter out null/empty)
        $serialNumbers = $invoices->pluck('serial_number')->filter()->unique()->values();

        //Build a safe filename using up to 3 serials (avoid too-long filenames)
        if ($serialNumbers->isEmpty()) {
            $fileName = 'invoice-' . $invoice_no . '.pdf';
        } else {
            $serialPart = $serialNumbers->take(3)->implode('-'); // e.g. SN123-SN124-SN125
            if ($serialNumbers->count() > 3) {
                $serialPart .= '-etc';
            }

            // Sanitize filename (remove spaces/special chars)
            $serialPart = Str::slug($serialPart, '-');
            $fileName = 'invoice-' . $invoice_no . '-' . $serialPart . '.pdf';
        }

        $pdf = PDF::loadView(
            'backend.product_invoice.partials.pdf_product_invoice',
            compact('invoices', 'customer', 'payments', 'total', 'paid', 'due', 'totalDue', 'shipping', 'cod', 'totalQuantity', 'netPayInWords')
        );

        // return $pdf->download('invoice-' . $invoice_no . '.pdf');
        return $pdf->download($fileName);
    }

    // public function productInvoiceEdit($invoice_no)
    // {
    //     $customers = User::where('role', 3)->latest()->get();
    //     // $products = Product::all();
    //     $products = Product::with(['serialNumbers' => function ($q) {
    //         $q->where('is_sold', false); // only available serials
    //     }])->get();

    //     $invoices = ProductInvoice::with(['customer', 'payments'])
    //         ->where('invoice_no', $invoice_no)
    //         ->get();

    //     if ($invoices->isEmpty()) {
    //         abort(404, 'Invoice not found.');
    //     }

    //     return view('backend.product_invoice.product_invoice_edit', compact('invoices', 'customers', 'products'));
    // }

    public function productInvoiceEdit($invoice_no)
    {
        $customers = User::where('role', 3)->latest()->get();

        // Products with only unsold serials
        $products = Product::with(['serialNumbers' => function ($q) {
            $q->where('is_sold', false); // only available serials
        }])->get();

        // Invoices with product and filtered serial numbers
        $invoices = ProductInvoice::with([
            'customer',
            'payments',
            'product' => function ($q) {
                $q->with(['serialNumbers' => function ($q2) {
                    $q2->where('is_sold', false); // only unsold serials
                }]);
            }
        ])->where('invoice_no', $invoice_no)->get();

        if ($invoices->isEmpty()) {
            abort(404, 'Invoice not found.');
        }

        return view('backend.product_invoice.product_invoice_edit', compact('invoices', 'customers', 'products'));
    }

    public function productInvoiceUpdate(Request $request, $invoice_no)
    {
        $invoices = ProductInvoice::where('invoice_no', $invoice_no)->get();

        if ($invoices->isEmpty()) {
            return back()->with('error', 'Invoice not found.');
        }

        foreach ($invoices as $index => $invoice) {

            // Update invoice fields
            if ($invoice->product_id) {
                $invoice->update([
                    'user_id'        => $request->user_id,
                    'name'           => $request->customer_name,
                    'email'          => $request->customer_email,
                    'phone'          => $request->customer_phone,
                    'address'        => $request->customer_address,
                    'product_code'   => $request->product_code[$index] ?? $invoice->product_code,
                    'quantity'       => $request->quantity[$index] ?? 1,
                    'regular_price'  => $request->regular_price[$index] ?? 0,
                    'discount_price' => $request->discount_price[$index] ?? 0,
                    'tax'            => $request->tax[$index] ?? 0,
                    'total_price'    => $request->total_price[$index] ?? 0,
                    'paid_amount'    => $request->paid_amount[$index] ?? 0,
                    'due_amount'     => $request->due_amount[$index] ?? 0,
                    'due_date'       => $request->due_date[$index] ?? null,
                    'shipping_cost'  => $request->shipping_cost[$index] ?? 0,
                    'cod_cost'       => $request->cod_cost[$index] ?? 0,
                    'payment_status' => $request->payment_status[$index] ?? 'unpaid',
                    'serial_number'  => $request->serial_number[$index] ?? '',
                    'warrenty'       => $request->warrenty[$index] ?? '',
                ]);
            } else {
                $invoice->update([
                    'user_id'             => $request->user_id,
                    'product_name'        => $request->product_name[$index] ?? $invoice->product_name,
                    'quantity'            => $request->quantity[$index] ?? 1,
                    'product_description' => $request->product_description[$index] ?? '',
                    'product_code'        => $request->product_code[$index] ?? '',
                    'regular_price'       => $request->regular_price[$index] ?? 0,
                    'discount_price'      => $request->discount_price[$index] ?? 0,
                    'tax'                 => $request->tax[$index] ?? 0,
                    'total_price'         => $request->total_price[$index] ?? 0,
                    'paid_amount'         => $request->paid_amount[$index] ?? 0,
                    'due_amount'          => $request->due_amount[$index] ?? 0,
                    'due_date'            => $request->due_date[$index] ?? null,
                    'shipping_cost'       => $request->shipping_cost[$index] ?? 0,
                    'cod_cost'            => $request->cod_cost[$index] ?? 0,
                    'payment_status'      => $request->payment_status[$index] ?? 'unpaid',
                    'serial_number'       => $request->serial_number[$index] ?? '',
                    'warrenty'            => $request->warrenty[$index] ?? '',
                ]);
            }

            //mark serial as sold
            if (!empty($request->serial_number[$index])) {
                ProductSerialNumber::where('serial_number', $request->serial_number[$index])
                    ->update(['is_sold' => true]);
            }


            // Update payments
            if (isset($request->payment_methods[$invoice->id]) && isset($request->amount[$invoice->id])) {
                $paymentMethods = $request->payment_methods[$invoice->id];
                $amounts = $request->amount[$invoice->id];

                foreach ($paymentMethods as $pIndex => $method) {
                    // dd($pIndex);
                    $amount = $amounts[$pIndex] ?? 0;

                    // Update existing payment
                    if (isset($invoice->payments[$pIndex])) {
                        $invoice->payments[$pIndex]->update([
                            'payment_method' => $method,
                            'amount' => $amount,
                        ]);
                    }
                }
            }
        }

        return redirect()
            ->route('product.all.invoice', $invoice_no)
            ->with('success', 'Invoice updated successfully.');
    }

    public function productInvoiceDelete($invoice_no)
    {
        $invoices = ProductInvoice::where('invoice_no', $invoice_no)->get();

        if ($invoices->isEmpty()) {
            return back()->with('error', 'No invoices found for this invoice number.');
        }

        foreach ($invoices as $invoice) {
            $invoice->delete();
        }

        InvoicePayment::where('invoice_no', $invoice_no)->delete();

        return redirect()
            ->route('product.all.invoice')
            ->with('success', 'Invoice(s) deleted successfully.');
    }

    // prduct invoice return
    public function productInvoiceReturn()
    {
        $invoices = ProductInvoice::with(['product', 'customer', 'payments'])
            ->where('return_status', 'pending')
            ->get();

        return view('backend.product_invoice.product_invoice_return', compact('invoices'));
    }

    public function productInvoiceReturnStore(Request $request)
    {
        $request->validate([
            'product_invoice_id' => 'required|exists:product_invoices,id',
            'return_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'refund_amount' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        ProductReturn::insert([
            'product_invoice_id' => $request->product_invoice_id,
            'return_date' => $request->return_date,
            'reason' => $request->reason,
            'refund_amount' => $request->refund_amount,
            'quantity' => $request->quantity,
            'status' => 'returned',
            'created_at' => now(),
        ]);

        // Update the product invoice status to returned
        ProductInvoice::where('id', $request->product_invoice_id)->update([
            'return_status' => 'returned',
        ]);

        return redirect()
            ->route('product.all.invoice')
            ->with('success', 'Invoice(s) returned successfully.');
    }

    public function productInvoiceReturnList()
    {
        $returns = ProductReturn::with(['productInvoice'])
            ->where('status', 'returned')
            ->paginate(10);

        return view('backend.product_invoice.product_invoice_return_list', compact('returns'));
    }
}
