<div class="row">
    <div class="col-md-6">
        <div class="form-group @error('title') has-error @enderror">
            {!! Form::label('title','Event Title') !!}
            {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Enter Event Title','required']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group @error('event_type_id') has-error @enderror">
            {!! Form::label('event_type_id','Select Event Category') !!}
            {!! Form::select('event_type_id',$eventTypes,null,['class'=>'form-control select2','placeholder'=>'Select Event Category','required']) !!}
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6">
        <div class="col-md-6 pl-lg-0 p-sm-0">
            <div class="form-group @error('date') has-error @enderror">
                {!! Form::label('date','Event Date') !!}
                {!! Form::date('date',null,['class'=>'form-control','required']) !!}
            </div>
        </div>
        <div class="col-md-6 pr-lg-0 p-sm-0">
            <div class="form-group @error('time') has-error @enderror">
                {!! Form::label('time','Event Date') !!}
                {!! Form::time('time',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group @error('organizer') has-error @enderror">
            {!! Form::label('organizer','Enter organizer name') !!}
            {!! Form::text('organizer',null,['class'=>'form-control','placeholder'=>'Enter Organizer name']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered" id="event-ticket">
            <thead>
            <tr>
                <th>Ticket</th>
                <th>Rate</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            @isset($event)
                @if($event->pricing)
                    @foreach($event->pricing as $pricing)
                        @include('backend.events.partials.pricing-tr',['pricing'=>$pricing])
                    @endforeach
                @else
                    @include('backend.events.partials.pricing-tr')
                @endif
            @else
                @include('backend.events.partials.pricing-tr')
            @endisset
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2">
                    <button type="button" onclick="addNewRow()"
                            class="btn btn-xs btn-primary btn-flat pull-left">
                        <i class="fa fa-plus-circle"></i> Add more
                    </button>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>
    <div class="col-md-6">
        <div class="form-group @error('address') has-error @enderror">
            {!! Form::label('address','Event Address/venue') !!}
            {!! Form::text('address',null,['class'=>'form-control','placeholder'=>'Enter address/venue.']) !!}
        </div>
    </div>
</div>
<div class="form-group @error('description') has-error @enderror">
    {!! Form::label('description','Event Description') !!}
    {!! Form::textarea('description',null,['class'=>'form-control','id'=>'description']) !!}
</div>
<div class="form-group @error('files') has-error @enderror">
    <div class="row">
        <div class="col-md-6 uploaded-file-list ">
            <label class="form-label">Upload Event Images</label>
            <div class="file-upload mt-3" role="button">
                <input type="file" name="image" class="d-none upload__input_file"
                       accept="image/png,image/jpg,image/jpeg">
                <label
                    class="text-center">
                    <i class="fa fa-upload"></i>
                    <p>Drag and Drop Image here or browse your file</p>
                </label>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="{{asset('/backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.file-upload').on('click', function (e) {
                e.stopPropagation();
                $('input:file')[0].click();
            })
        })
        jQuery(document).ready(function () {
            ImgUpload();
        });

        function removeImage(ele) {
            let index = ele.data('number');
            $('form').append('<input type="hidden" name="removed_index[]" value="' + index + '">')
            ele.parent().parent().remove();
        }

        function ImgUpload() {
            let imgWrap = "";
            let imgArray = [];
            $('.upload__input_file').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.uploaded-file-list');
                    let files = e.target.files;
                    let filesArr = Array.prototype.slice.call(files);
                    let iterator = 0;
                    let maxLength = 3;
                    filesArr.forEach(function (f, index) {
                        if (!f.type.match('image.*')) return;
                        if (imgArray.length > maxLength) return false
                        else {
                            let len = 0;
                            for (let i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) return false;
                            else {
                                imgArray.push(f);
                                let reader = new FileReader();
                                reader.onload = function (e) {
                                    let html = '<div class="file-list">' +
                                        '<div class="align-vertical">' +
                                        '<img src="' + e.target.result + '" alt="Event Image" class="file-image"  data-file="' + f.name + '">' +
                                        '</div>' +
                                        '<div class="align-vertical">' +
                                        '<button class="btn btn-xs btn-flat btn-danger me-2" type="button" data-number="' + $(".file-list").length + '" onclick="removeImage($(this))">' +
                                        '<i class="fa fa-trash"></i></button>' +
                                        '</div>' +
                                        '</div>';
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);

                                // reader.onload = function (e) {
                                //     console.log(e.target)
                                //     let html = `<div class="file-list">
                                //                 <div class="align-vertical">
                                //                 <img src="${e.target.result}" alt="Event Image" class="file-image"/>
                                //                 </div>
                                //             <div class="align-vertical">
                                //                 <button class="btn btn-xs btn-flat btn-danger me-2" type="button" onclick="removeImage($(this))">
                                //                      <i class="fa fa-trash"/>
                                //                 </button>
                                //                 </div>
                                //             </div>`;
                                //     imgWrap.append(html);
                                // }
                                // reader.readAsDataURL(e.target.files[0]);
                            }
                        }
                    });
                });
            });
        }

        $(function () {
            CKEDITOR.replace('description');
        })

        function addNewRow() {
            let row = $('#event-ticket>tbody').children(':last-child').clone();
            row.find("input:text").val("")
            row.find("input[type='select']").val("")
            $('#event-ticket>tbody>tr:last').after(row);
        }

        function removeRow(ele) {
            let tr = ele.closest('tr');
            if (tr.parent().children().length > 1) {
                ele.closest('tr').remove();
            }
            return 0;
        }

    </script>
@endpush
