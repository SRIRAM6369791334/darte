<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Cart;

class AccountController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();
        $cartCount = Cart::where('user_id', $user->id)->count();

        return view('pages.account-profile', compact('user', 'wishlistCount', 'cartCount'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\user $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:15',
            'password' => 'nullable|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $oldName = $user->name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->hasFile('profile_image')) {
            // OLD — storage/app/public (forbidden issue)
            // $imagePath = $request->file('profile_image')->store('profiles', 'public');

            // NEW — directly public/profiles/ folder-ல save
            $file = $request->file('profile_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('profiles'), $filename);

            // Delete old image if exists
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }

            $user->profile_image = 'profiles/' . $filename;
        }

        // Sync address names if they match the old profile name or are empty
        if (empty($user->billing_name) || $user->billing_name == $oldName) {
            $user->billing_name = $request->name;
        }
        if (empty($user->shipping_name) || $user->shipping_name == $oldName) {
            $user->shipping_name = $request->name;
        }
        if (empty($user->billing_phone) || $user->billing_phone == $user->getOriginal('phone_number')) {
            $user->billing_phone = $request->phone_number;
        }
        if (empty($user->shipping_phone) || $user->shipping_phone == $user->getOriginal('phone_number')) {
            $user->shipping_phone = $request->phone_number;
        }

        // Sync with multi-address table (user_addresses)
        \Illuminate\Support\Facades\DB::table('user_addresses')
            ->where('user_id', $user->id)
            ->where(function ($query) use ($oldName) {
                $query->where('address_username', $oldName)
                    ->orWhereNull('address_username');
            })
            ->update([
                'address_username' => $request->name,
                'address_phone_number' => $request->phone_number
            ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Profile updated successfully!'
        ]);
    }

    public function address()
    {
        $user = Auth::user();
        $wishlistCount = \App\Models\Wishlist::where('user_id', $user->id)->count();
        $cartCount = \App\Models\Cart::where('user_id', $user->id)->count();
        $states = \App\Models\State::all();
        $userAddresses = \Illuminate\Support\Facades\DB::table('user_addresses')
            ->where('user_id', $user->id)
            ->get();
        $latestOrder = \App\Models\ProductOrder::where('user_id', $user->id)->latest()->first();

        return view('pages.account-address', compact('user', 'wishlistCount', 'cartCount', 'states', 'userAddresses', 'latestOrder'));
    }

    public function updateAddress(Request $request)
    {
        /** @var \App\Models\user $user */
        $user = Auth::user();
        $type = $request->address_type; // 'billing' or 'shipping'

        if ($type === 'billing') {
            $request->validate([
                'billing_name' => 'required|string|max:255',
                'billing_phone' => 'required|string|max:15',
                'billing_door_no' => 'required|string',
                'billing_street' => 'required|string',
                'billing_city' => 'required|string',
                'billing_state' => 'required|string',
                'billing_pincode' => 'required|string',
            ]);

            $user->update($request->only([
                'billing_name',
                'billing_phone',
                'billing_door_no',
                'billing_street',
                'billing_area',
                'billing_city',
                'billing_state',
                'billing_pincode'
            ]));
        } else {
            $request->validate([
                'shipping_name' => 'required|string|max:255',
                'shipping_phone' => 'required|string|max:15',
                'shipping_door_no' => 'required|string',
                'shipping_street' => 'required|string',
                'shipping_city' => 'required|string',
                'shipping_state' => 'required|string',
                'shipping_pincode' => 'required|string',
            ]);

            $user->update($request->only([
                'shipping_name',
                'shipping_phone',
                'shipping_door_no',
                'shipping_street',
                'shipping_area',
                'shipping_city',
                'shipping_state',
                'shipping_pincode'
            ]));
        }

        return back()->with([
            'type' => 'success',
            'message' => ucfirst($type) . ' address updated successfully!'
        ]);
    }
}
