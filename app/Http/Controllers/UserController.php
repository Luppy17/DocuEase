<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException; // For password errors
use App\Models\User; // Ensure you have this model
use App\Models\Department; // You'll need this model if not already created
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showAccountManagementForm()
    {
        $user = Auth::user();
        $departments = Department::orderBy('dept_name')->get(); // Fetch all departments for dropdown
        $page = 'my-account';

        return view('staff.my-account', compact('user', 'departments', 'page'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'dept_id' => 'nullable|exists:department,dept_id', // Validate department ID
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Only update department if user's role allows it or if it's applicable
        if (Auth::user()->role === 'Staff' || Auth::user()->role === 'Manager') { // Example: Only staff/manager can change department
            $user->dept_id = $request->input('dept_id');
        }

        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Profile updated successfully!']);
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['status' => 'success', 'message' => 'Password updated successfully!']);
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Optional: Require password confirmation before deletion
        // if (!Hash::check($request->password, $user->password)) {
        //     return response()->json(['status' => 'error', 'message' => 'Password confirmation failed.'], 403);
        // }

        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        $user->delete();

        return response()->json(['status' => 'success', 'message' => 'Your account has been deleted successfully.']);
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Profile photo updated successfully!',
                'photo_url' => $user->profile_photo_url
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No photo uploaded'
        ], 400);
    }
}
