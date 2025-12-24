<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $addrInfo = $user->shippingAddresses;
        return view('address.index', ['addrInfo' => $addrInfo]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_fullname' => 'required|string|min:3',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        ShippingAddress::create([
            'user_id' => $request->user()->id,
            'receiver_fullname' => $validated['receiver_fullname'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        // $fullUrl = $request->request_from;
        // $path = parse_url($fullUrl, PHP_URL_PATH);

        // if ($path === '/checkout') {
        //     return redirect($fullUrl);
        // }
        
        return redirect()
                ->intended(route('address.index'))
                ->with('success', 'Add address successfully !!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShippingAddress $address)
    {
        return view('address.edit', ['address' => $address]);     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShippingAddress $address)
    {
        $validated = $request->validate([
            'receiver_fullname' => 'required|string|min:3',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $address->update($validated);
        $address->save();
        return redirect()->route('address.index')->with('success', 'Update Successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingAddress $address)
    {
        $address->delete();
        return back()->with('success', 'Delete Successfully !!');
    }
}
