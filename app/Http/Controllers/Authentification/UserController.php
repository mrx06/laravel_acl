<?php
declare (strict_types = 1);
namespace App\Http\Controllers\Authentification;

use Auth;
use DB;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

use App\Model\Authentification\User as Model;
use App\Model\Authentification\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    }

    public function index(Request $request): View
    {
        $search = null;
        if ($request->has('search')) {
            $search = $request->input('search');
            $models = Model::where('email', 'ilike', '%'.$search.'%')
                           ->orWhere('name', 'ilike', '%'.$search.'%')
                           ->where('id', '!=', Auth::user()->id)
                           ->where('name', '!=', 'administrator')
                           ->orderBy('name')
                           ->paginate();
        } else {
            $models = Model::where('id', '!=', Auth::user()->id)->where('name', '!=', 'Admin')->orderBy('name')->paginate();
        }
        return view('authentification.user.index')->with(compact('models', 'search'));
    }

    public function toggleActive(string $id): RedirectResponse
    {
        $model = Model::findOrFail($id);
        $model->active = !$model->active;
        $model->save();
        return redirect()->back()->withInput();
    }

    public function toggleAllowAddProposal(string $id): RedirectResponse
    {
        $model = Model::findOrFail($id);
        $model->is_allow_add = !$model->is_allow_add;
        $model->save();
        return redirect()->back()->withInput();
    }

    public function toggleAllowEditProposal(string $id): RedirectResponse
    {
        $model = Model::findOrFail($id);
        $model->is_allow_edit_proposal = !$model->is_allow_edit_proposal;
        $model->save();
        return redirect()->back()->withInput();
    }

    public function toggleAllowAddCommunityService(string $id): RedirectResponse
    {
        $model = Model::findOrFail($id);
        $model->is_allow_add_cs = !$model->is_allow_add_cs;
        $model->save();
        return redirect()->back()->withInput();
    }

    public function toggleAllowEditCommunityService(string $id): RedirectResponse
    {
        $model = Model::findOrFail($id);
        $model->is_allow_edit_cs = !$model->is_allow_edit_cs;
        $model->save();
        return redirect()->back()->withInput();
    }

    public function allEnableEditProposal(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_edit_proposal' => true]);
        return redirect()->route('authentification.user.index');
    }

    public function allDisableEditProposal(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_edit_proposal' => false]);
        return redirect()->route('authentification.user.index');
    }

    public function allEnableAddProposal(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_add' => true]);
        return redirect()->route('authentification.user.index');
    }

    public function allDisableAddProposal(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_add' => false]);
        return redirect()->route('authentification.user.index');
    }

    public function allEnableEditCommnityService(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_edit_cs' => true]);
        return redirect()->route('authentification.user.index');
    }

    public function allDisableEditCommnityService(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_edit_cs' => false]);
        return redirect()->route('authentification.user.index');
    }

    public function allEnableAddCommnityService(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_add_cs' => true]);
        return redirect()->route('authentification.user.index');
    }

    public function allDisableAddCommnityService(): RedirectResponse
    {
        DB::connection('authentification')->table('authentification.users')->update(['is_allow_add_cs' => false]);
        return redirect()->route('authentification.user.index');
    }

    public function resetUserAccount(string $id): RedirectResponse
    {
        $model = Model::findOrFail($id);
        $model->email = $model->name.'@unhas.ac.id';
        $model->password = Hash::make($model->name);
        $model->is_password_reseted = true;
        $model->save();
        return redirect()->route('authentification.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $model = Model::findOrFail($id);
        $roles = Role::paginate();
        return view('authentification.user.show')->with(compact('model', 'roles'));
    }

    public function addRole(string $id, Request $request)
    {
        $model = Model::findOrFail($id);
        $role = Role::findOrFail($request->input('role_id'));
        $model->roles()->detach($role->id);
        $model->roles()->attach($role->id);
        return redirect()->route('user.show', $id);
    }

    public function removeRole(string $id, Request $request)
    {
        $model = Model::findOrFail($id);
        $role = Role::findOrFail($request->input('role_id'));
        $model->roles()->detach($role->id);
        return redirect()->route('user.show', $id);
    }
}
