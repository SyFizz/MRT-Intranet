<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        if(!auth()->user()->isAdmin) {
            return to_route('dashboard')->with('error', 'Vous n\'avez pas accès à cette page');
        } else {
            return view('settings.index');
        }
    }

    public function usersIndex()
    {
        if(!auth()->user()->isAdmin) {
            return to_route('dashboard')->with('error', 'Vous n\'avez pas accès à cette page');
        }
        $users = User::orderBy('name')->paginate(50);
        return view('settings.users.index')->with('users', $users);
    }

    public function usersSearch(Request $request)
    {
        $users = User::where('id', 'like', '%'.$request->search.'%')
            ->orWhere('name', 'like', '%'.$request->search.'%')
            ->orWhere('email', 'like', '%'.$request->search.'%')
            ->orderBy($request->has('sort') ? $request->sort : 'name')
            ->paginate(50);
        return view('settings.users.index')->with('users', $users)->with('search', $request->search);
    }

    public function usersCreate()
    {
        return view('settings.users.create');
    }

    public function usersStore(UserCreateRequest $request){


        $user = new User();
        $user->name = $request->validated()['name'];
        $user->email = $request->validated()['email'];
        $user->password = Hash::make($request->validated()['password']);
        if($request->validated()['isAdmin'] == 'Oui')
            $user->isAdmin = true;
        else
            $user->isAdmin = false;
        $user->save();

        return to_route('settings.users')->with('success', 'Utilisateur ' . $user->name . ' créé avec succès');

    }

    public function usersEdit(int $id)
    {
        return view('settings.users.edit')->with('user', User::find($id));
    }

    public function usersUpdate(UserUpdateRequest $request, int $id): RedirectResponse
    {
        $user = User::find($id);
        $user->name = $request->validated()['name'];
        $user->email = $request->validated()['email'];
        if($request->validated()['isAdmin'] == 'Oui')
            $user->isAdmin = true;
        else
            $user->isAdmin = false;
        $user->save();
        return to_route('settings.users')->with('success', 'Utilisateur ' . $user->name . ' modifié avec succès');
    }

    public function usersResetPassword(int $id): RedirectResponse
    {
        $user = User::find($id);

        //Generate a random string with 12 [a-zA-Z0-9] characters
        $password = Factory::create()->regexify('[A-Za-z0-9]{12}');
        $user->password = Hash::make($password);
        $user->save();
        return to_route('settings.users')->with('success', 'Mot de passe de l\'utilisateur ' . $user->name . ' réinitialisé. Nouveau mot de passe : ' . $password);
    }

    public function usersDestroy(int $id): RedirectResponse
    {
        $user = User::find($id);
        $user->delete();
        return to_route('settings.users')->with('success', 'Utilisateur ' . $user->name . ' supprimé avec succès');
    }

}
