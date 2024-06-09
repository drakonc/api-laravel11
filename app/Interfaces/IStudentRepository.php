<?php

namespace App\Interfaces;

interface IStudentRepository
{
    public function GetAll();
    public function GetById(int $id);
    public function Store(array $data);
    public function Update(int $id, array $data);
    public function Delete(int $id);
}
