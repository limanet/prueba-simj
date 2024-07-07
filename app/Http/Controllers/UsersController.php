<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $user;

    public function __construct() {
        $this->user = auth::user();
    }

    public function usersList( Request $request )
    {
        $users = User::where( function ( $query ) use ( $request ) {
            if ( $request->has( 'search' ) )
                $query->where( 'name', 'like', '%' . $request->search . '%' )->orWhere( 'email', 'like', '%' . $request->search . '%' );
        } )->paginate( 25 );

        return view('users.list', [
            'users' => $users,
            'user'  => $this->user,
        ] );
    }

    public function newUser( Request $request )
    {
        return view( 'users.form', [ 'logged_user' => $this->user ] );
    }

    public function editUser( Request $request )
    {
        $user_id = $request->user_id;

        //Comprobamos si el usuario existe
        $user = User::find( $user_id );
        if ( ! $user ) {
            return redirect()->route( 'users.list' );
        }

        return view( 'users.form', [
            'user_id'     => $user->id,
            'logged_user' => $this->user,
            'user'        => $user
        ] );
    }

    public function saveUser( Request $request )
    {
        $request->validate( [
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required_without:user_id',
            'password_confirmation' => 'required_with:password|same:password',
        ], [
            'name.required'                       => 'Por favor, introduce el nombre del usuario',
            'email.required'                      => 'Por favor, introduce el email del usuario',
            'email.email'                         => 'Por favor, introduce un email válido',
            'password.required_without'           => 'Por favor introduce la contraseña para el nuevo usuario',
            'password_confirmation.required_with' => 'Por favor, confirma la contraseña para el nuevo usuario',
            'password_confirmation.same'          => 'La contraseña y su confirmación no coinciden',
        ] );

        if ( $this->emailExists( $request->email, $request->user_id ?? null ) ) {
            return redirect()->back()->withErrors( [ 'email' => 'Ya existe un usuario registrado con este e-mail' ] )->withInput();
        }

        if ( $request->has( 'user_id' ) ) {
            $user = User::find( $request->user_id );
        } else {
            $user = new User;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ( $request->has( 'password' ) ) {
            $user->password = Hash::make( $request->password );
        }
        $user->save();

        return redirect()->route( 'users.index' );
    }

    public function deleteUser( Request $request )
    {
        $user_id = $request->user_id;

        User::where( 'id', $user_id )->delete();

        return redirect()->route( 'users.index' );
    }


    private function emailExists( $email, $user_id = null)
    {
        $user = User::where( 'email', $email )->where( function ( $query ) use ( $user_id ) {
            if ( $user_id ) {
                $query->where( 'id', '!=', $user_id );
            }
        } )->count();

        return ( $user > 0 ) ? true : false;
    }
}
