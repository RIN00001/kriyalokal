<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\SellerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SellerApplicationController extends Controller
{
    public function create()
    {
        return view('seller-applications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $user = auth()->user();

        if ($user->seller) {
            return redirect()->route('dashboard')
                ->with('status', 'You are already registered as a seller.');
        }

        DB::transaction(function () use ($request, $user) {
            SellerApplication::create([
                'user_id' => $user->id,
                'shop_name' => $request->shop_name,
                'description' => $request->description,
                'status' => 'approved',
                'reviewed_at' => now(),
            ]);

            Seller::create([
                'user_id' => $user->id,
                'shop_name' => $request->shop_name,
                'slug' => Str::slug($request->shop_name . '-' . $user->id),
                'description' => $request->description,
                'status' => 'active',
            ]);

            $user->update([
                'role' => 'seller',
            ]);
        });

        return redirect()->route('dashboard')
            ->with('status', 'Seller account created successfully.');
    }
}