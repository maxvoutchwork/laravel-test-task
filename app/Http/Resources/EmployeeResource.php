<?php

namespace App\Http\Resources;

use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        is_null($this->employee_id) ?: $employee = Employee::find($this->employee_id);
        return [
            'id' => $this->id,
            'photo' => $this->photo,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'salary' => $this->salary,
            'date_of_employment' => $this->date_of_employment,
            'position' => ['id' => $this->position->id, 'title' => $this->position->title],
            'head' => !is_null($this->employee_id) ? ['id' => $employee->id, 'name' => $employee->name] : '',
            'admin_created_id' => $this->admin_created_id,
            'admin_updated_id' => $this->admin_updated_id,
            'created_at' => Carbon::create( $this->created_at,)->format('d.m.Y'),
            'updated_at' => Carbon::create($this->updated_at)->format('d.m.Y'),
        ];
    }
}
