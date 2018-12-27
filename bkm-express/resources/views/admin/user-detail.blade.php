@extends('layouts/admin_template')

@section('content')
   <!-- Main content -->
   <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail</h3>
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
                    
                <div class="row">
                
                    <div class="col-md-8">

                    <dl>
                        <dt>Name :</dt>
                        <dd>{{ $value->name }}</dd>
                        <dt>Email :</dt>
                        <dd>{{ $value->email }}</dd>
                        <dt>Phone :</dt>
                        <dd>{{ $value->profile->phone }}</dd>
                        <dt>Address :</dt>
                        <dd>{{ $value->profile->address }}</dd>
                        <dt>Role :</dt>
                        <dd>{{ config('constants.USER.ROLE')[$value->role] }}</dd>
                        <dt>Status :</dt>
                        <dd>{{ config('constants.USER.STATUS_ACTIVE')[$value->is_active] }}</dd>
                    </dl>

                    </div>

                    <div class="col-md-4 text-right">
                        <img src="{{ Auth::user()->profile->getAvatarUrlAttribute() }}" class="img-square elevation-1" alt="User Image">
                    </div>
                </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" class="btn btn-default" onclick="history.back();">Back</button>
                </div>
              </form>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection