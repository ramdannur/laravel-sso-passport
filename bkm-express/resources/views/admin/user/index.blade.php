@extends('layouts/admin_template')

@section('content')

<div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">List Data</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">

                  <div class="row">
                    <div class="col-md-8"></div>
                    <form method="GET" class="col-md-4">
                          <div class="pull-right">
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
                      <div class="callout callout-{{ $msg }}">
                          <p >{{ Session::get('alert-' . $msg) }} </p>
                      </div> <!-- end .flash-message -->
                    @endif
                  @endforeach
                    <form id="general-form" method="POST">
                      {{ csrf_field() }}
                        <table class="table table-hover table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width: 4%">No. </th>
                              <th>Nama Lengkap</th>
                              <th>Email</th>
                              <th>No. Handphone</th>
                              <th>Alamat</th>
                              <th>Status</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                               @foreach ($list_data as $key=>$value)
                                <?
                                      $i = (($list_data->currentPage() - 1) * $list_data->perPage()) +  $key;
                                ?>
                                    <tr>
                                      <td>{{ ++$i }}</td>
                                      <td><a href="{{ route('detail-user', $value->id) }}">{{ $value->name }}</a></td>
                                      <td>{{ $value->email }}</td>
                                      <td>{{ $value->profile->phone }}</td>
                                      <td>{{ $value->profile->address }}</td>
                                      <td>
                                        {{ Config::Get('constants.user.status_active')[$value->is_active] }}
                                      </td>
                                      <td>
                                      <a href="#" class="btn btn-sm btn-primary">Edit User</a>
                                      </td>
                                    </tr>
                            
                                @endforeach
                           </tbody>
                          </table>
                      </form>
                    </div>
                  {{ $list_data->links() }}

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
   <div>

@endsection

