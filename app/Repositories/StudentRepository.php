<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\IStudentRepository;
use App\Models\Student;

class StudentRepository implements IStudentRepository
{
    public function GetAll()
    {
        return Student::all();
    }

    public function GetById(int $id)
    {
        return Student::findOrFail($id);
    }

    public function Store(array $data)
    {
        return Student::create($data);
    }

    public function Update(int $id, array $data)
    {
        return Student::whereId($id)->update($data);
    }

    public function Delete(int $id)
    {
        return Student::destroy($id);
    }
}
