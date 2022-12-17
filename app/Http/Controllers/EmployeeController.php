<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $employee = Employee::all();

        return EmployeeResource::collection($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->only(
            'photo',
            'name',
            'email',
            'phone_number',
            'salary',
            'date_of_employment',
            'position_id',
            'employee_id',
        ) + [
            'admin_created_id' => Auth::user()->id,
            'created_at' => Carbon::now()->format('d.m.Y'),
            ]);
        return response(new EmployeeResource($employee), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return EmployeeResource
     */
    public function show($id)
    {
        return new EmployeeResource(Employee::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->only(
                'photo',
                'name',
                'email',
                'phone_number',
                'salary',
                'date_of_employment',
                'position_id',
                'employee_id',
            ) + [
                'admin_updated_id' => Auth::user()->id,
                'updated_at' => Carbon::now()->format('d.m.Y'),
            ]);

        return response(new EmployeeResource($employee), 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::where('employee_id', '=', $id)->get();
        $get_employee = Employee::find($id);
        if($get_employee->value('employee_id') != '') {
            foreach ($employees as $employee) {
                $employee->update(['employee_id' => $get_employee->value('employee_id')]);
            }
        } else {
            foreach ($employees as $employee) {
                $employee->update(['employee_id' => '']);
            }
        }
        Employee::destroy($id);

        return response(null, 204);
    }

    public function list()
    {
        $employees = Employee::all();
        $employee_list = [];
        foreach ($employees as $employee) {
            $check = Employee::where('employee_id', '=', $employee->id);
            if(!$check->value('id')) {
                $employee_list[] = ['id' => $employee->id, 'name' => $employee->name];
            }
        }
        return $employee_list;
    }
}
