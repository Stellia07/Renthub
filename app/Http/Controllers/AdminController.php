<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Property;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function AdminDashboard() {
        // Retrieve count of listings per month
        $monthlyListings = Property::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_listings')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Map numeric month to month names
        $monthNames = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        // Replace numeric month with month names
        $monthlyListings->transform(function ($item) use ($monthNames) {
            $item->month = $monthNames[$item->month];
            return $item;
        });

        // Count total number of owners
        $totalOwners = User::where('role', 'owner')->count();

        // Count total number of active owners
        $activeOwners = User::where('role', 'owner')->where('status', 'active')->count();

        // Count total number of inactive owners
        $inactiveOwners = User::where('role', 'owner')->where('status', 'inactive')->count();

        // Count total number of tenants
        $totalTenants = Tenant::count();
        
        $activePropertiesCount = Property::where('status', '1')->count();
        $propertyData = Property::select('created_at', 'status')->orderBy('created_at')->get();
        $property = Property::latest()->get();
    
        return view('admin.index', compact('property', 'activePropertiesCount', 'propertyData', 'monthlyListings', 'totalOwners', 'totalTenants', 'activeOwners', 'inactiveOwners'));
    }

    public function AdminLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully!',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
    } // End Method

    public function AdminLogin() {

    	return view('admin.admin_login');

    } // End Method

    public function AdminProfile() {

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));

    } // End Method

    public function AdminProfileStore(Request $request) {
        
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

    public function AdminChangePassword() {

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));

    } // End Method


    public function AdminUpdatePassword(Request $request) {

        // Validations
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // Match Old Pass ng admin

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Your Old Password Does not Match!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);

        }

        // Update Of new password

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    } // End Method


    public function AllOwner(){

        $allowner = User::where('role','owner')->get();
        return view('backend.owneruser.all_owner',compact('allowner'));

    }// End Method

    public function AddOwner(){

        return view('backend.owneruser.add_owner');

    }// End Method 


    public function StoreOwner(Request $request){

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'owner',
            'status' => 'active', 
        ]);


        $notification = array(
            'message' => 'Owner Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.owner')->with($notification); 


    }// End Method 


    public function EditOwner($id){

        $allowner = User::findOrFail($id);
        return view('backend.owneruser.edit_owner',compact('allowner'));

    }// End Method


    public function UpdateOwner(Request $request){

        $user_id = $request->id;

        User::findOrFail($user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address, 
        ]);


       $notification = array(
            'message' => 'Owner Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.owner')->with($notification);  

    }// End Method 


    public function DeleteOwner($id){

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Owner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }// End Method 


    public function changeStatus(Request $request){

        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status Change Successfully']);

    }// End Method 


}
