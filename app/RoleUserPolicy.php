<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RoleUserPolicy extends Model
{

    use HasFactory;

    //role id
    private $etudiant = 1;

    private $teacher = 2;

    private $admin = 3;

    private $jury = 4;



    public function role($id){
        foreach(session()->get('roles') as $role){
            if ($role->id == $id){
                return true;
            }
        }
        return false;
    }

    /**
     * @return int
     */
    public function getEtudiant(): int
    {
        return $this->etudiant;
    }

    /**
     * @return int
     */
    public function getTeacher(): int
    {
        return $this->teacher;
    }

    /**
     * @return int
     */
    public function getAdmin(): int
    {
        return $this->admin;
    }

    /**
     * @return int
     */
    public function getJury(): int
    {
        return $this->jury;
    }
}
