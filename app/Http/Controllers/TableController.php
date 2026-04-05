<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Table\CreateTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Services\TableService;
use App\Traits\ResponseTrait;

class RoomController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        return $this->success(
            TableResource::collection(
                TableService::query()->where('status', 'active')->get()
            )
        );
    }

    public function store(CreateTableRequest $request)
    {
        return $this->success(
            TableResource::make(
                TableService::create($request->validated())
            )
        );
    }

    public function show(Table $table)
    {
        return $this->success(
            TableResource::make($table)
        );
    }

    public function update(UpdateTableRequest $request, Table $room)
    {
        return TableResource::make(
            TableService::update($request->validated(), $room)
        );
    }

    public function destroy(Table $table)
    {
        TableService::delete($table);
        return $this->success('delete room successfuly');
    }
}

