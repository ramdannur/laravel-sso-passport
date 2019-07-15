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
                        <a href="{{ route('branch-create') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i>
                            Add New
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
                    <th>City</th>
                    <th>Address</th>
                    <th>Code</th>
                    <th>Phone</th>
                    <th>Fax</th>
                    <th>Contact</th>
                    <th>Cellular</th>
                    <th style="width: 130px">Action</th>
                  </tr>
                  
                @foreach ($list_data as $key=>$value)
                    <?
                            $i = (($list_data->currentPage() - 1) * $list_data->perPage()) +  $key;
                    ?>
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td><a href="{{ route('branch-detail', $value->id) }}">{{ $value->city }}</a></td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->code }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->fax }}</td>
                        <td>{{ $value->contact }}</td>
                        <td>{{ $value->cellular }}</td>
                        <td>
                            <a href="{{ route('branch-edit', $value->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('branch-delete', $value->id) }}" class="btn btn-sm btn-danger">Delete</a>
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