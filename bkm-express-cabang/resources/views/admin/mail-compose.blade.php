@extends('layouts/admin_template')

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12">
            <form method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Compose New Message</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group">
                    <input class="form-control" placeholder="To:" name="to">
                  </div>
                  <div class="form-group">
                    <input class="form-control" placeholder="Subject:" name="subject">
                  </div>
                  <div class="form-group">
                      <textarea id="compose-textarea" class="form-control" style="height: 300px" placeholder="Type your message ..."  name="content">
                      </textarea>
                  </div>
                  <!-- <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Attachment
                      <input type="file" name="attachment">
                    </div>
                    <p class="help-block">Max. 20MB</p>
                  </div> -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div class="float-right">
                    <!-- <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                  <button type="reset" class="btn btn-default" onclick="history.back();"><i class="fa fa-times"></i> Discard</button>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /. box -->
            </form>
            <!-- /. form -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->

    </section>
    <!-- /.content -->
@endsection

@section('js')
  <script src="{{ asset ("/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}" type="text/javascript"></script>
  <script>
  $(function () {
    $('#compose-textarea').wysihtml5({
      toolbar: { fa: true }
    })
  })
  </script>
@endsection