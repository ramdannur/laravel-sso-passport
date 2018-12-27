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
                    <label for="bill_to">Bill To</label>
                    <input type="text" name="bill_to" class="form-control" id="bill_to" placeholder="Enter bill to" value="{{ @$value->bill_to }}">
                  </div>
                  <div class="form-group">
                    <label for="ship_to">Ship To</label>
                    <input type="text" name="ship_to" class="form-control" id="ship_to" placeholder="Enter ship to" value="{{ @$value->ship_to }}">
                  </div>
                  <div class="form-group">
                    <label for="ship_address">Ship Address</label>
                    <textarea class="form-control" name="ship_address" id="ship_address" rows="3" placeholder="Enter ship address">{{ @$value->ship_address }}</textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="unit">Unit</label>
                  
                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Qty</th>
                                    <th>Description</th>
                                    <th style="width: 20%">Price</th>
                                    <th style="width: 5%" class="text-center">#</th>
                                </tr>
                            </thead>
                            <tbody id="unit_container">
                            
                            </tbody>
                        </table>
                    </div>

                    <a onclick="addUnit()" class="btn btn-sm btn-default">
                        <i class="fa fa-plus"></i>
                        Add Unit
                    </a>
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

@section('js')
<script>
    $(function () {
        addUnit();
    });

    function removeElement(e, msg){
        if (confirm(msg)){
        e.remove();
        return true;
        }else{
        return false;
        }
    }

    function removeParentElement(e){
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }
    
    function addUnit(){
        var html = '<tr>\
                        <td><input type="number" class="form-control" placeholder="" name="qty[]" required></td>\
                        <td><input type="text" class="form-control" placeholder="" name="description[]" required></td>\
                        <td><input type="number" class="form-control" placeholder="" name="price[]" required></td>\
                        <td><a onclick="removeParentElement(this)" class="btn btn-sm btn-default" title="Cancel"><i class="fa fa-close"></i></a></td>\
                    </tr>';

            $('#unit_container').append(html);

    }
</script>
@endsection