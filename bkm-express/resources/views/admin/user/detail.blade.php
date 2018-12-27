@extends('layouts/admin_template')

@section('content')

<div class='row'>
        <div class='col-md-12'>
            <!-- Box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Data</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
{{-- 
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
                  </div> --}}

                  <br>

                  <div class="table-responsive mailbox-messages">
                  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                      <div class="callout callout-{{ $msg }}">
                          <p >{{ Session::get('alert-' . $msg) }} </p>
                      </div> <!-- end .flash-message -->
                    @endif
                  @endforeach
                      <div class="col-md-12">
                      
                          <form class="form-horizontal" method="post">

                            <div class="form-group">
                              <label class="col-sm-2 control-label">Nama</label>
                              
                              <div class="col-sm-10" style="padding-top:7px">
                                : {{ $value->name }}
                              </div>

                            </div> 

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                
                                <div class="col-sm-10" style="padding-top:7px">
                                    : {{ $value->email }}
                                </div>

                            </div> 

                            @if($value->profile)
                            
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Alamat</label>
                              
                              <div class="col-sm-10" style="padding-top:7px">
                                : {{ $value->profile->address }}
                              </div>

                            </div>
                            
                            <div class="form-group">
                              <label class="col-sm-2 control-label">Phone</label>
                              
                              <div class="col-sm-10" style="padding-top:7px">
                                : {{ $value->profile->phone }}
                              </div>

                            </div>

                            @endif
                            <br>
                            <br>

                          </form>
                      </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="#" class="btn btn-default" onclick="window.history.back();">Back</a>
                </div>
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
   <div>

@endsection

