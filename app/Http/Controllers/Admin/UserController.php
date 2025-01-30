<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->paginate();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated  = $request->validate([
           'name' => ['required','max:255'],
           'email' => ['required','email','max:255','unique:users,email'],
            // если наше поле в форме name=password_confirmation , то можно просто передать  confirmed, в противном случае confirmed:название_поля
            'password' => ['required','min:6','confirmed'],
            // 1 , 0, поэтому в value ставим 1 , так как по деффолту приходит on
            'is_admin'=>['boolean']
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = ($request->input('password'));
        $user->is_admin = $request->boolean('is_admin');
        $user->save();

        return response()->json([
            'status'=>'success',
            'data'=> 'User added successfully',
            'redirect'=>route('users.index'),
        ]);


        return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::query()->findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);
        $validated  = $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email','max:255','unique:users,email,'.$id],
            // nullable может быть в том случае , если пользователь не захочет менять пароль
            'password' => ['nullable','min:6','confirmed'],
            // 1 , 0, поэтому в value ставим 1 , так как по деффолту приходит on
            'is_admin'=>['boolean']
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->boolean('is_admin');
        // если пришёл пароль , то записываем его и обновляем
        if ($request->filled('password')) {
            $user->password = $request->input('password');
        }
        $user->save();


        return response()->json([
            'status'=>'success',
            'data'=> 'User updated successfully',
            'redirect'=>route('users.index'),
        ]);


        return redirect()->route('users.index')->with('success','User updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::query()->findOrFail($id);
        // если user id равен текущему пользователю , то-бишь что-бы сам себя не удалил
        if($user->id == auth()->user()->getAuthIdentifier()){
            return redirect()->route('users.index')->with('error','You cannot delete yourself');
        }
        $user->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');
    }
}
