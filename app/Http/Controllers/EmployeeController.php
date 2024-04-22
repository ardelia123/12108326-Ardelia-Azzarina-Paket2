<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employee.dashboard');
    }

    public function product(Request $request)
{
    $search = $request->input('search');
    
    if ($search) {
        $product = Product::where('name', 'LIKE', "%{$search}%")->paginate(10); 
        $product->appends(['search' => $search]);
    } else {
        $product = Product::paginate(10); 
    }
    
    return view('employee.product', compact('product'));
}

    public function transaction()
    {
        $sale = Sale::with(['customer', 'detail'])->paginate(5);

        return view('employee.transaction', compact('sale'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::get();
        return view('employee.add', compact('product'));
    }

    public function store(Request $request)
{
    $request->validate([
        'products.*.name' => 'required',
        'products.*.qty' => 'required',
        'products.*.price' => 'required',
        'products.*.id' => 'required',
    ]);

    $products = collect($request->input('products'))
        ->map(function ($product) {
            $product['qty'] = intval($product['qty']);
            $product['price'] = intval($product['price']);
            $product['id'] = intval($product['id']);
            $product['total'] = $product['qty'] * $product['price'];
            return $product;
        })
        ->filter(function ($product) {
            $qty = intval($product['qty']);
            return $qty > 0;
        });

    return view('cashier.create', [
        'products' => $products,
        'total' => $products->sum('total'),
    ]);
}


public function save(Request $request)
{
    $data = $request->validate([
        'products.*.qty' => 'required',
        'products.*.id' => 'required',
        'products.*.price' => 'required',
        'products.*.total' => 'required',
        'name' => 'required',
        'address' => 'required',
        'no_hp' => 'required',
    ]);

    $products = collect($data['products']);

    DB::transaction(function () use ($data, $products) {
        $customer = Customer::create([
            'nama' => $data['name'],
            'alamat' => $data['address'],
            'telepon' => $data['no_hp'],
        ]);

        $sale = new Sale([
            'tanggal' => now(),
            'total' => $products->sum('total'),
        ]);
        
        $sale->user_id = auth()->user() ? auth()->user()->id : null;
        
        $customer->sale()->save($sale);
        
        // Membuat input detail penjualan
        $sale->detail()->createMany($products->map(function ($product) {
            return [
                'product_id' => $product['id'],
                'amount' => $product['qty'],
                'subtotal' => $product['total'],
                'user_id' => auth()->user() ? auth()->user()->id : null,
            ];
        }));

        // biar stoknya kejual
        $products->each(function ($product) {
            $productInStock = Product::find($product['id']);
            $newStock = $productInStock->stok - $product['qty'];
            $productInStock->update(['stok' => $newStock]);
        });
    });

    return redirect()->route('employee.transaction')->with('success', 'Transaction Created');
}


public function delete($id)
    {
        $transaction = Sale::findOrFail($id);
        $transaction->delete();
        return redirect()->route('employee.transaction')->with('success', 'Transaksi berhasil dihapus.');
    }

    // public function createPDF()
    // {
    //     $data['sales'] = Sale::with(['customer', 'detail'])->get(); 

    //    $pdf = Pdf::loadView('transaksi', $data);
    //    return $pdf->download("Transaksi.pdf");

    // }

//     public function createExcel()
// {
//     $data['sales'] = Sale::with(['customer', 'detail'])->get(); 

//     return Excel::download(function($excel) use ($data) {
//         $excel->sheet('rekap', function($sheet) use ($data) {
//             $sheet->loadView('rekap', $data);
//         });
//     }, "Rekap.xlsx");
// }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
