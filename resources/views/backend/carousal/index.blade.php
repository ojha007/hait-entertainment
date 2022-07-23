@extends('backend.master')
@section('title_postfix')
    | Carousal
@endsection
@section('header')
    Slider Image
@endsection
@section('subHeader')
    Carousal
@endsection
@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        All Slider images are listed here.
                    </h3>
                    <div class="box-tools pull-right">
                        <div class="btn btn-flat btn-sm btn-primary pull-right" data-toggle="modal"
                             data-target="#ticket-modal" type="button">
                            <i class="fa fa-plus-circle"></i>
                            Add Ticket Type
                        </div>
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                        </tr>
                        </thead>
                        <tbody>
                        @inject('buttonHelper','App\Services\TableButtonService')
                        @forelse($images as $image)
                            <tr>
                                <td>{{$image->title}}</td>
                                <td>
                                    <img src="{{asset($image->url)}}" alt="{{$image->title}}" width="200px"
                                         height="100px">
                                </td>
                                <td>
                                    {!! $buttonHelper->deleteButton($routePrefix.'carousals.destroy',$image->id) !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-bold">No Record Found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add/Edit Slider Image</h3>
                </div>
                {!! Form::open(['route'=>$routePrefix.'carousals.store','files'=>true,'method'=>'POST']) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('title') !!}
                        {!! Form::text('title',null,['class'=>'form-control','required','placeholder'=>'Enter Title']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Upload File') !!}
                        {!! Form::file('image',['class'=>'form-control','required','accept'=>'image/png,image/jpg,image/jpeg']) !!}
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-flat btn-primary btn-sm">
                        <i class="fa fa-save"></i>
                        Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

