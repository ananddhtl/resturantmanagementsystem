<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $file = File::query()->where('file_name', '=', $validated_data['image'])->first();
            $validated_data['image_id'] = $file->id;
            unset($validated_data['image']);
        }
        User::query()->create($validated_data);
        return redirect()->route('admin.users.index')->with('notification', 'User has been added successfully!');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, string $id)
    {
        $user = User::query()->findOrFail($id);
        $validated_data = $request->validated();
        if (isset($validated_data['image'])) {
            $file = File::query()->where('file_name', '=', $validated_data['image'])->first();
            $validated_data['image_id'] = $file->id;
            unset($validated_data['image']);
        }
        unset($validated_data['password']);
        $user->update($validated_data);
        return redirect()->route('admin.users.index')->with('notification', 'User has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('notification', 'User has been deleted successfully!');
    }
}
