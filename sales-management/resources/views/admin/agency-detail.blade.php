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
                        <dt>Branch :</dt>
                        <dd>
                        @if($value->branch)
                        <a href="{{ route('branch-detail', $value->branch->id) }}">{{ $value->branch->city }}</a>
                        @else
                        --
                        @endif
                        </dd>
                        <dt>City :</dt>
                        <dd>{{ $value->city }}</dd>
                        <dt>Status :</dt>
                        <dd>{{ config('constants.BRANCH.TIPE')[$value->status] }}</dd>
                        <dt>Address :</dt>
                        <dd>{{ $value->address }}</dd>
                        <dt>Code :</dt>
                        <dd>{{ $value->code }}</dd>
                        <dt>Phone :</dt>
                        <dd>{{ $value->phone }}</dd>
                        <dt>Fax :</dt>
                        <dd>{{ $value->fax }}</dd>
                        <dt>Contact :</dt>
                        <dd>{{ $value->contact }}</dd>
                        <dt>Cellular :</dt>
                        <dd>{{ $value->cellular }}</dd>
                        <!-- <dt>Secret Key :</dt>
                        <dd>{{ $value->key }}</dd> -->
                    </dl>

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