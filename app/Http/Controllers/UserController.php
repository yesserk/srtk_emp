<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
public function index()
            {
                $users = User::all(); 
            
                return view('users/users', compact('users'));
            }

public function add()
            {    $users = User::all(); 
            
                return view('users/users_form', compact('users'));
                
            }

            public function store(Request $request)
            {
                // Validate the input data
                $validatedData = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:8',
                ]);
    
                // Create a new user
                User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                ]);
    
                return redirect()->route('users')->with('success', 'تم اضافة المستخدم بنجاح');
            }
    

public function deleteUser($id)
        {
            $user = User::find($id);

            if ($user) {
                $user->delete();
                return redirect()->route('users')->with('success', 'تم حذف المستخدم بنجاح.');
            } else {
                return redirect()->route('users')->with('error', 'فشل في حذف المستخدم.');
            }
        }

public function editUser($id)
            {
                $user = User::find($id);

                if ($user) {
                    return view('users/users_edit', compact('user'));
                } else {
                    return redirect()->route('users')->with('error', 'المستخدم غير موجود.');
                }
            }


            public function updateUser(Request $request, $id)
{
    $user = User::find($id);
    
    if ($user) {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Check if the password field is not empty (indicating a password change)
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        
        $user->save();

        return redirect()->route('users')->with('success', 'تم تحديث المستخدم بنجاح.');
    } else {
        return redirect()->route('users')->with('error', 'فشل في تحديث المستخدم.');
    }
}

            public function addPermission($UserId)
                    {    $user = User::find($UserId);
                        
                        $permission = Permission::where('user_id' , $UserId);
                        dd($permission->users);
                    
                        return view('users/permission_form', compact('user','permission'));
                        
                    }

                    public function storePermission(Request $request,$UserID)
                    {
                        //dd($UserID);
                        // Validate the input data
                        $permissionValidatedData = $request->validate([
                            'user_id'=> $UserID,
                            'users' => 'required|in:0,1,2',
                            'employee' => 'required|in:0,1,2',
                            'type_employee' => 'required|in:0,1,2',
                            'etat_employee' => 'required|in:0,1,2',
                            'gare' => 'required|in:0,1,2',
                            'bus' => 'required|in:0,1,2',
                            'ligne' => 'required|in:0,1,2',
                            'station' => 'required|in:0,1,2',
                            'voyage' => 'required|in:0,1,2',
                        ]);
                
                        // Create a new Permission record with the validated data
                        Permission::create([
                            'user_id' => $UserID,
                            'users' => $permissionValidatedData['users'],
                            'employee' => $permissionValidatedData['employee'],
                            'type_employee' => $permissionValidatedData['type_employee'],
                            'etat_employee' => $permissionValidatedData['etat_employee'],
                            'gare' => $permissionValidatedData['gare'],
                            'bus' => $permissionValidatedData['bus'],
                            'ligne' => $permissionValidatedData['ligne'],
                            'station' => $permissionValidatedData['station'],
                            'voyage' => $permissionValidatedData['voyage'],

                        ]);
                
                        return redirect()->route('users')->with('success', 'تم تعيين المستخدم');
                    }

        

}


