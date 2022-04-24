<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\emailNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Validation\Rule;

class UserController extends Controller
  {
    public function __construct()
    {
         $this->middleware(['auth','Admin']);
    }

    public function index(Request $request)

    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.user.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.create',compact('roles'));
    }

    public function store(Request $request)

    {     
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'role' => 'required'
        ]);
       
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create([
            'id' =>  json_encode($request['id']),
            'name' =>  json_encode($request['name']),
            'email' =>  json_encode($request['email']),
            'password' => json_encode( $request['password']),
            'role' => json_encode( $request['role']),
        ]);
      
        $user->syncRoles( $request['role']);

        return redirect('users')->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show',compact('user'));
    }

    public function edit($id)

    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => 'same:confirm-password',
            'role' => 'required'
        ]);
    
        $input = $request->all();

        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }

        $user = User::find($id);
        $user->update($input);
        FacadesDB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->syncRoles($request->input('role'));

        return redirect('users')->with('success','User updated successfully');
    }

    public function destroy($id)

    {
        User::find($id)->delete();
        return redirect('users')->with('success','User deleted successfully');
    }


    public function list(){
        $users = User::get();
        return view('admin.user.index',compact('users'));
    }

    public function customerlist(){
        $users = User::where('as_vendor', NULL)->get();
        return view('admin.user.index',compact('users'));
    }

    public function vendorsToAccept(){
        $vendors = User::where('as_vendor', 0)-> get();
        return view('admin.vendor.accept',compact('vendors'));
    }
    public function vendorsList(){
        $vendors = User::where('as_vendor', 1)-> get();
        return view('admin.vendor.list',compact('vendors'));
    }

    public function acceptVendor(Request $request){
        $vendor = User::where('id', $request->id)-> first();
        $vendor['as_vendor'] = 1;
        $vendor->attachRole('vendor');
        $vendor->update();
        $msg = "Welcome" ;
        (new NotificationController)->sendNotification($vendor , $msg);
        return redirect()->route('vendors.list');
    }
    public function declineVendor(Request $request){
        $vendor = User::where('id', $request->id)-> first();
        $data=[
            'head'=>'Decline Email',
            'body'=>'Your order to be a vendor is rejected because',
            'urlaction'=>$vendor->email,
        ];
        Notification::send($vendor,new emailNotification($data));
        $vendor->delete();
        return redirect()->route('vendors.to.acceptl')->with('success','Email sends successfuly');
    }
    public function blockVendor(Request $request){
        $vendor = User::where('id', $request->id)->first();
        $vendor['as_vendor'] = 0;
        $vendor->detachRole('vendor');
        $vendor->update();
        $msg = "You are blocked Now, for more information contact with admin" ;
        (new NotificationController)->sendNotification($vendor , $msg);
        return redirect()->route('vendors.list');
    }



}
