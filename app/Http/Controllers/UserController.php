<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    //
    public function welcome()
    {
        return view('welcome');
    }

    public function admin()
    {
        $user_count = User::count();
        return view('pages.admin.content-admin', compact('user_count'));
    }

    public function tables()
    {
        return view('pages.admin.tables');
    }

    public function userCreate()
    {
        return view('pages.admin.profile_user');
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.user_create');
    }

    public function emp()
    {
        return view('pages.emp.emp');
    }

    public function showtable()
    {
        $users = User::all();

        $usershit =User::Count();

        return view ('pages.admin.tables', ['users' =>$users]);
    }

    public function index()
    {
        $user = User::latest()->paginate(5);

        return view('admin.index', compact('user'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

    public function edit($user_id)
    {
        // ini dapatin data yang hanya satu paling depan jadi lagnsgun aja dipanggil datanya
        $user = User::where('id', $user_id)->firstOrFail(); // pakai yang ini karena cuman manggil user dengan id nya

        // ini dpatin data banyak berarti harus di foreach biar bisa akses data nya
        // $users = User::where('id', $user_id)->get();

        // cara liat perbedaannya gini,, pake in aja dd($namavariabel)

        // ini yang datanya cuman satu
        // dd($user);
        // dd($user->id);

        // ini yang datanya banya
        // dd($users);
        // dd($users[0]->id);

        return view('pages.admin.tableedit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'level' => 'required',
            // 'cost' => 'required'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->level
        ]);

        return redirect()->route('admin')
            ->with('success', 'Data user updated successfully');
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();

        return redirect()->route('admin')
            ->with('success', 'Data user deleted successfully');
    }

    public function cleanup($table_name)
    {
        DB::statement("ALTER TABLE `$table_name` AUTO_INCREMENT = 1;");
    }
}
