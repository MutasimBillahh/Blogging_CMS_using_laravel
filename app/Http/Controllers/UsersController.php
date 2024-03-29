<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
        public function __construct(){
            $this->middleware('admin');

        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required',
            'email' =>'required|email'
            


         ]);

        $user = User::create([

            'name' =>$request->name,
            'email' =>$request->email,
            'password' => bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/1.png'


        ]);

         /*$user = new User();

         $user->name =$request->name;
         $user->email =$request->email;
         $user->password = bcrypt('password');


         $profile = new Profile();

         $profile->user_id =$request->user_id;

         $user->save();
         $profile->save();*/

         Session::flash('success', 'User Created Succesfully');
         return redirect()->route('users');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admin($id){
        $user = User::find($id);

        $user->admin = 1;
        $user->save();
        Session::flash('success', 'Permission Created Succesfully');
         return redirect()->route('users');
    }

     public function not_admin($id){
        $user = User::find($id);

        $user->admin = 0;
        $user->save();
        Session::flash('success', 'Permission Created Succesfully');
         return redirect()->route('users');
    }
}
