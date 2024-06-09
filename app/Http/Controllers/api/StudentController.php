<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Interfaces\IStudentRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class StudentController extends Controller
{

    private IStudentRepository $studentRepository;

    public function __construct(IStudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $data =  $this->studentRepository->GetAll();
        return ApiResponseHelper::sendResponse(StudentResource::collection($data), '', 200);
    }

    public function show(string $id)
    {
        $student  = $this->studentRepository->GetById($id);
        return ApiResponseHelper::sendResponse(new StudentResource($student), '', 200);
    }

    public function store(StoreStudentRequest $request)
    {
        $data = [
            'name' => $request->name,
            'age' => $request->age,
        ];
        DB::beginTransaction();
        try {
            $student = $this->studentRepository->Store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new StudentResource($student), 'Registro creado satisfactoriamente', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(string $id,UpdateStudentRequest $request)
    {
        $data = [
            'name' => $request->name,
            'age' => $request->age
        ];
        DB::beginTransaction();
        try {
            $this->studentRepository->Update($id, $data);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Registro editado correctamente', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function destroy(string $id)
    {
        $this->studentRepository->Delete($id);
        return ApiResponseHelper::sendResponse(null, 'Registro eliminado correctamente', 200);
    }
}
