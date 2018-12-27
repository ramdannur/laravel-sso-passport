<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
{

    private $title = "Branch Management";

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

        $model = Branch::Where('status', config('constants.BRANCH.AGEN_UTAMA'))->OrderBy('City', 'asc');
        
        if ($request->has('q')){
            $model = $model->Where('city', 'LIKE', '%'.$request->q.'%');
        }

        $data['list_data'] = $model->paginate(10);

        return view('admin.branch-index')->with($data);
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

        return view('admin.branch-form')->with($data);
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

        $model = new Branch();
        $model->status = config('constants.BRANCH.AGEN_UTAMA'); 
        $model->city = $input['city']; 
        $model->address = $input['address']; 
        $model->code = $input['code']; 
        $model->phone = $input['phone']; 
        $model->fax = $input['fax']; 
        $model->contact = $input['contact']; 
        $model->cellular = $input['cellular']; 
        
        // Save Data
        $model->save();

        $request->session()->flash('alert-success', _('Add Branch Success'));

		return redirect()->intended(route('branch-index'));
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

        $model = Branch::findOrFail($id);

        $data['value'] = $model;
        
        return view('admin.branch-detail')->with($data);
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

        $model = Branch::findOrFail($id);

        $data['value'] = $model;

        return view('admin.branch-form')->with($data);
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

        $model = Branch::find($id);
        $model->city = $input['city']; 
        $model->address = $input['address']; 
        $model->code = $input['code']; 
        $model->phone = $input['phone']; 
        $model->fax = $input['fax']; 
        $model->contact = $input['contact']; 
        $model->cellular = $input['cellular']; 

        // Save Data
        $model->save();

        $request->session()->flash('alert-success', _('Update Branch Success'));

		return redirect()->intended(route('branch-index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Branch::find($id);
        if($model){
            $model->delete();
            $request->session()->flash('alert-success', _('Delete Branch Success'));
        }else{
            $request->session()->flash('alert-danger', _('Delete Branch Failed'));
        }
		return redirect()->intended(route('branch-index'));
    }
}
