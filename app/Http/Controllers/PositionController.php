<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionResource;
use App\Models\Employee;
use App\Models\Position;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $position = Position::all();

        return PositionResource::collection($position);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionRequest $request)
    {
        $position = Position::create($request->only(
            'title'
        ) + [
                'admin_created_id' => Auth::user()->id,
                'created_at' => Carbon::now()->format('d.m.Y'),
            ]);
        return response(new PositionResource($position), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return PositionResource
     */
    public function show($id)
    {
        return new PositionResource(Position::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePositionRequest  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionRequest $request, $id)
    {
        $position = Position::find($id);
        $position->update($request->only(
                'title',
            ) + [
                'admin_updated_id' => Auth::user()->id,
                'updated_at' => Carbon::now()->format('d.m.Y'),
            ]);

        return response(new PositionResource($position), 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::where('position_id', '=', $id)->get();
        foreach ($employees as $employee) {
            $employee->update(['position_id' => '1']);
        }
        Position::destroy($id);

        return response(null, 204);
    }

    public function list()
    {
        $positions = Position::all();
        $arr_list = [];
        foreach ($positions as $position) {
            $arr_list[] = ['id' => $position->id, 'title' => $position->title];
        }
        return $arr_list;
    }
}
