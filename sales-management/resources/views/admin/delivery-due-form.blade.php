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
                    <!-- Date dd/mm/yyyy -->
                    <div class="form-group">
                    <label>Due Date:</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" name="due_date" id="due_date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>
                    <!-- /.input group -->
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
<script src="{{ asset ("/plugins/input-mask/jquery.inputmask.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/plugins/input-mask/jquery.inputmask.date.extensions.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/plugins/input-mask/jquery.inputmask.extensions.js") }}" type="text/javascript"></script>
<script>
  $(function () {
    $('#due_date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  })
</script>
@endsection