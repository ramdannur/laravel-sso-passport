@extends('layouts/admin_template')

@section('content')
   <!-- Main content -->
   <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form</h3>
            </div>
            <form method="POST" role="form">
                @csrf
                <div class="card-body">

                <div class="table-responsive mailbox-messages">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                      <div class="alert alert-{{ $msg }} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-info"></i>{{ Session::get('alert-' . $msg) }} 
                      </div>
                    @endif
                    @endforeach
                </div>
                  <div class="form-group">
                    <label for="branch">Branch</label>
                    <select class="form-control" name="branch" required="true">
                        <option value="">{{ __("Choose Branch") }}</option>
                        @foreach($list_branch as $item)
                            <option value="{{ $item->id }}" {{ @$value->branch_id==$item->id?"Selected":"" }}>{{ $item->city }} - {{ $item->address }} ({{ config('constants.BRANCH.TIPE')[$item->status] }})</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" name="type" required="true">
                        <option value="">{{ __("Choose Type") }}</option>
                        @foreach($list_tipe as $key => $item)
                            <option value="{{ $key }}" {{ @$value->status==$key?"Selected":"" }}>{{ $item }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" value="{{ @$value->city }}">
                  </div>
                  <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" name="code" class="form-control" id="code" placeholder="Enter code" value="{{ @$value->code }}">
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone" value="{{ @$value->phone }}">
                  </div>
                  <div class="form-group">
                    <label for="fax">Fax</label>
                    <input type="text" name="fax" class="form-control" id="fax" placeholder="Enter fax" value="{{ @$value->fax }}">
                  </div>
                  <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" class="form-control" id="contact" placeholder="Enter contact" value="{{ @$value->contact }}">
                  </div>
                  <div class="form-group">
                    <label for="cellular">Cellular</label>
                    <input type="text" name="cellular" class="form-control" id="cellular" placeholder="Enter cellular" value="{{ @$value->cellular }}">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address">{{ @$value->address }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <div class="float-right">
                  <button type="button" class="btn btn-default" onclick="history.back();">Back</button>
                  </div>
                </div>
              </form>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection