<div class="modal fade" id="ticket-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-md">
        {!!  Form::open(['route'=>$masterRoute.'tickets.store','class'=>'modal-form','method'=>'POST'])!!}
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create New Ticket Type</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name') !!}
                    {!! Form::text('name',null,['class'=>'form-control',
                            'required','placeholder'=>'Create New Ticket','autocomplete'=>'off']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                    Close
                </button>
                <button class="btn btn-primary btn-flat pull-right"
                        type="submit">
                    <i class="fa fa-save"></i>
                    Submit
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
