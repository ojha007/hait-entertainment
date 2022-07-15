<tr>
    <td>
        {!! Form::select('ticket_type_id[]',$tickets,$pricing->ticket_type_id ?? null,
                            ['class'=>'form-control','placeholder'=>'Select Ticket Type']) !!}
    </td>
    <td>
        {!! Form::text('rate[]',$pricing->rate ?? null,['class'=>'form-control','placeholder'=>'Enter Rate',]) !!}
    </td>
    <td>
        {!! Form::text('seat[]',$pricing->seat ?? null,['class'=>'form-control','placeholder'=>'Enter Total Seat']) !!}
    </td>
    <td>
        <button class="btn btn-danger btn-flat btn-xs" type="button" onclick="removeRow($(this))">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>
