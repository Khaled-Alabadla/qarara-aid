<?php

namespace App\Imports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        // Retrieve the "employee" role
        $role = Role::where('name', 'موظف')->first();
    
        // Create the user
        $user = new User([
            'name'            => $row[0], // Column A: Name
            'identity_number' => $row[1], // Column B: Identity Number
            'phone'           => $row[2], // Column C: Phone
            'family_size'     => $row[3], // Column D: Family Size
            'password'        => Hash::make($row[4]), // Column E: Plain Password
            'position'        => $row[5], // Column F: Position
        ]);
    
        // Save the user
        $user->save();
    
        // Assign the role if it exists
            $user->roles()->attach($role); // Attach the role to the user
        
    
        return $user;
    }
    
}
