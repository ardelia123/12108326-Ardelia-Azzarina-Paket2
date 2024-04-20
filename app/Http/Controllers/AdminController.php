<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Detail;


class AdminController extends Controller
{

//untuk return view login logout
    public function login()
    {
        return view('login');
    }

    public function auth(Request $request){

        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)) {
            $userName = Auth::user()->name;
            if (Auth::user()->role == 'admin'){
                return redirect()->route('admin')->with('userName', $userName);
            } elseif (Auth::user()->role == 'cashier') {
                return redirect()->route('employee')->with('userName', $userName);
            }
        } else {
            return redirect()->back()->with('errorLogin','Login gagal');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    
    public function user()
    {
        $users = User::get();
        return view('admin.user',compact('users'));
    }

    public function create_user()
    {
        return view('admin.tambahuser');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        Auth::login($user);

        return redirect('/admin.user')->with('successRegister', 'New account has been created!');
    }

    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    public function update_user(Request $request, User $user, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => $request->password,
            ]);
            return redirect('/admin.user')->with('success', 'Account Edited!');
        } catch (\Exception $error) {
            return redirect()->back()->with('errorEdit', $error->getMessage());
        }
    }
    public function delete_user($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return redirect()->back()->with('successDelete', 'delete succeed!');
    }
    // public function product(Request $request) {
    //     $search = $request->input('search');
    
    //     if ($search) {
    //         $product = Product::where('name_product', 'LIKE', "%{$search}%")->paginate(10); 
    //         $product->appends(['search' => $search]);
    //     } else {
    //         $product = Product::paginate(10); 
    //     }
        
    //     return view('admin.product', compact('produk'));
    // }

    public function create_product()
    {
        return view('admin.tambahproduk');
    }

}
