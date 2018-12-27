@extends('layouts/admin_template')

@section('content')
   <!-- Main content -->
   <section class="content">

        <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Read Mail</h3>

                    <div class="card-tools">
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                    <div class="mailbox-read-info">
                        <h5>{{ $value->subject }}</h5>
                        <h6>To: {{ $value->to }}
                        <span class="mailbox-read-time float-right">{{ $value->sendDate }}</span></h6>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <!-- <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                            <i class="fa fa-trash-o"></i></button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                            <i class="fa fa-reply"></i></button>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                            <i class="fa fa-share"></i></button>
                        </div>
                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                        <i class="fa fa-print"></i></button>
                    </div> -->
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        {!! $value->content !!}
                    </div>
                    <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.card-body -->
                    <!-- <div class="card-footer bg-white">
                        <ul class="mailbox-attachments clearfix">
                            <li>
                                <span class="mailbox-attachment-icon"><i class="fa fa-file"></i></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name">Sep2014-report.pdf</a>
                                        <span class="mailbox-attachment-size">
                                        1,245 KB
                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                        </span>
                                </div>
                            </li>
                        </ul>
                    </div> -->
                    <!-- /.card-footer -->
                    <!-- <div class="card-footer">
                        <div class="float-right">
                            <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                            <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                        </div>
                        <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                        <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                    </div>
                     -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-default" onclick="history.back();">Back</button>
                    </div>
                    <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
@endsection