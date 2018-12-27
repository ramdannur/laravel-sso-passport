<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use DB;
use Auth;

class UserController extends Controller
{
    private $title = "Users Management";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();

        $data['page_title'] = $this->title;

        // $data['page_description'] = "Lorem ipsum dolor sit amet";

        $model = User::OrderBy('name', 'asc');
        
        if ($request->has('q')){
            $model = $model->Where('name', 'LIKE', '%'.$request->q.'%')->OrWhere('email', 'LIKE', '%'.$request->q.'%');
        }

        $data['list_data'] = $model->paginate(5);

        return view('admin.user-index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();

        $data['page_title'] = $this->title;

        $data['list_role'] = config('constants.USER.ROLE');

        return view('admin.user-form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        try{

            DB::beginTransaction();

            $modelUser = new User;
            $modelUser->name = $input['name'];
            $modelUser->email = $input['email'];
            $modelUser->role = $input['role'];
            $modelUser->password = bcrypt($input['password']);
            $modelUser->is_admin = 1;
            $modelUser->save();
            
            $modelProfile = new Profile;
            $modelProfile->user_id = $modelUser->id;
            $modelProfile->phone = $input['phone'];
            $modelProfile->address = $input['address'];
            $modelProfile->save();

            DB::commit();

            $request->session()->flash('alert-success', _('Add User Success'));

        } catch (\Exception $e) {

            DB::rollback();
        
        }

		return redirect()->intended(route('user-index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();

        $data['page_title'] = $this->title;

        $model = User::findOrFail($id);

        $data['value'] = $model;
        
        return view('admin.user-detail')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();

        $data['page_title'] = $this->title;

        $model = User::findOrFail($id);

        $data['value'] = $model;

        $data['list_role'] = config('constants.USER.ROLE');
        
        return view('admin.user-form')->with($data);
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
        $input = $request->all();

        try{

            DB::beginTransaction();

            $modelUser = User::find($id);
            $modelUser->name = $input['name'];
            $modelUser->email = $input['email'];
            $modelUser->role = $input['role'];
            
            if(!empty($input['password'])){
                $modelUser->password = bcrypt($input['password']);
            }
            $modelUser->is_admin = 1;
            $modelUser->save();
            
            $modelProfile = Profile::where('user_id', $id)->first();
            $modelProfile->user_id = $modelUser->id;
            $modelProfile->phone = $input['phone'];
            $modelProfile->address = $input['address'];
            $modelProfile->save();

            DB::commit();

            $request->session()->flash('alert-success', _('Update User Success'));

        } catch (\Exception $e) {

            DB::rollback();
        
        }

		return redirect()->intended(route('user-index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = User::find($id);
        if($model && (Auth::user()->id != $id)){
            $model->delete();
            $request->session()->flash('alert-success', _('Delete User Success'));
        }else{
            $request->session()->flash('alert-danger', _('Delete User Failed'));
        }
		return redirect()->intended(route('user-index'));
    }
}
