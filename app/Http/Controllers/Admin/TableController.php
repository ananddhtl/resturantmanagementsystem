<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.tables.index', ['tables' => $tables]);
    }

    public function create()
    {
        return view('admin.tables.create');
    }


    public function store(TableRequest $request)
    {
        $validated_data = $request->validated();
        Table::query()->create($validated_data);
        return redirect()->route('admin.tables.index')->with('notification', 'Table has been added successfully!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $table = Table::query()->findOrFail($id);
        return view('admin.tables.edit', ['table' => $table]);
    }

    public function update(TableRequest $request, string $id)
    {
        $table = Table::query()->findOrFail($id);
        $validated_data = $request->validated();
        $table->update($validated_data);
        return redirect()->route('admin.tables.index')->with('notification', 'Table has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $table = Table::query()->findOrFail($id);
        $table->delete();
        return redirect()->route('admin.tables.index')->with('notification', 'Table has been deleted successfully!');
    }
}
