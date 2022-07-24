<div class="modal fade" id="user-modal" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit User Detail</h4>
            </div>
            {!! Form::open(['url'=>'internal/users','class'=>'modal-form']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name') !!}
                    {!! Form::text('name',null,['class'=>'form-control',
                            'required','placeholder'=>'Enter Name','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email') !!}
                    {!! Form::text('email',null,['class'=>'form-control',
                            'required','placeholder'=>'Enter Email','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone') !!}
                    {!! Form::text('phone',null,['class'=>'form-control',
                            'required','placeholder'=>'Enter phone number','readonly'=>'readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status') !!}
                    {!! Form::select('status',['approved'=>'Approved','rejected'=>'Rejected','pending'=>'Pending'],null,
                            ['class'=>'form-control','required','placeholder'=>'Select Status']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-flat pull-right">
                    <i class="fa fa-edit"></i> Update
                </button>
                <button type="reset" class="btn btn-danger btn-flat pull-left" data-dismiss="modal">
                    <i class="fa fa-remove"></i> Reset
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
