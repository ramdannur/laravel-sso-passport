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
                    
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>{{ $value->bill_to }}</strong><br>
                            </address>
                            To
                            <address>
                                <strong>{{ $value->ship_to }}</strong><br>
                                {{ $value->ship_address }}.
                            </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                            <b>Transaction Code #{{ $value->code }}</b><br>
                            <br>
                            <b>Branch:</b> 
                                @if($value->branch)
                                <a href="{{ route('branch-detail', $value->branch->id) }}">{{ $value->branch->city }}</a>
                                @else
                                --
                                @endif<br>
                            <b>Ship Date:</b> {{ date('d/m/Y', strtotime($value->created_at)) }}<br>
                            <b>Due Date:</b>
                            @if(!empty($value->due_date))
                            {{ date('d/m/Y', strtotime($value->due_date)) }}
                            @else
                            <a href="{{ route('delivery-edit', $value->id) }}">Add Due Date</a>
                            @endif
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                            <th>Qty</th>
                            <th>Description</th>
                            <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($value->unit as $key=>$value)
                            @php
                                $total += $value->qty*$value->price;
                            @endphp
                                <tr>
                                <td>{{ $value->qty }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ "Rp " . number_format($value->price,0,',','.') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfooter>
                            <tr>
                            <td class="text-right" colspan="2"><strong>Total</strong></td>
                            <td>{{ "Rp " . number_format($total,0,',','.') }}</td>
                            </tr>
                            </tfooter>
                        </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

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