@extends('layouts/admin_template')

@section('content')
   <!-- Main content -->
   <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List</h3>
                
                <form method="GET" class="card-tools">
                  <div class="input-group input-group-sm">
                    <input type="text" name="q" class="form-control" placeholder="Search Mail" value="{{ @$_GET['q'] }}">
                    <div class="input-group-append">
                      <button type="submit" id="search-btn" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                      </button>
                    </div>
                  </form>
                </div>
            </div>
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
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach($list_data as $value)
                  <tr>
                    <td style="width:30px"><input type="checkbox"></td>
                    <td class="mailbox-star" style="width:30px"><a href="{{ route('mail-star', ['outbox', $value->id]) }}"><i class="fa {{ $value->is_star=='1'?'fa-star':'fa-star-o' }} text-warning"></i></a></td>
                    <td class="mailbox-name"><a href="{{ route('mail-outbox-detail', $value->id) }}">{{ $value->to }}</a></td>
                    <td class="mailbox-subject">{{ substr(strip_tags($value->content), 0, 100) }}
                    </td>
                    <td class="mailbox-attachment"></td>
                    <td class="mailbox-date" style="width:120px">{{ $value->sendDateElapse }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
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