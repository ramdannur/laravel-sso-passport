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
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ @$value->name }}">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ @$value->email }}">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" class="form-control" id="password" placeholder="Enter password" value="">
                  </div>
                  <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" name="role" required="true">
                        <option value="">{{ __("Choose Role") }}</option>
                        @foreach($list_role as $key => $item)
                            <option value="{{ $key }}" {{ @$value->role==$key?"Selected":"" }}>{{ $item }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone" value="{{ @$value->profile->phone }}">
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address">{{ @$value->profile->address }}</textarea>
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