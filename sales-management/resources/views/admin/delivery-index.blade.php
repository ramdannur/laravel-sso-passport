@extends('layouts/admin_template')

@section('content')
   <!-- Main content -->
   <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <a href="{{ route('delivery-create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>
                            New Transaction
                        </a>
                    </div>

                    <form method="GET" class="col-md-4">
                        <div class="float-right">
                        <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ @$_GET['q'] }}">
                            <span class="input-group-btn">
                                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        </div>
                    </form>
                </div>

                <br>

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
            <table class="table table-bordered">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Code</th>
                    <th>Bill To</th>
                    <th>Ship To</th>
                    <th>Ship Address</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </tr>
                  
                @foreach ($list_data as $key=>$value)
                    <?
                            $i = (($list_data->currentPage() - 1) * $list_data->perPage()) +  $key;
                    ?>
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><a href="{{ route('delivery-detail', $value->code) }}">#{{ $value->code }}</a></td>
                        <td>{{ $value->bill_to }}</td>
                        <td>{{ $value->ship_to }}</td>
                        <td>{{ $value->ship_address }}</td>
                        <td>
                        @if(!empty($value->due_date))
                        {{ date('d/m/Y', strtotime($value->due_date)) }}
                        @else
                        <a href="{{ route('delivery-edit', $value->id) }}">Add Due Date</a>
                        @endif
                        </td>
                        <td>
                            <!-- <a href="{{ route('delivery-edit', $value->id) }}" class="btn btn-sm btn-warning">Edit</a> -->
                            <a href="{{ route('delivery-delete', $value->id) }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-default" onclick="history.back();">Back</button>
                <div class="float-right">
                  {{ $list_data->links() }}
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection