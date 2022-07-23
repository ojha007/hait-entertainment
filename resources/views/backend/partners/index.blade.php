@extends('backend.master')
@section('title_postfix')
    | Our Partners
@endsection
@section('header')
    Partners
@endsection
@section('subHeader')
    Partners
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        All organization are as a partner listed here.
                    </h3>
                    <div class="box-tools pull-right">
                    </div>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @inject('buttonHelper','App\Services\TableButtonService')
                        @forelse($partners as $partner)
                            <tr>
                                <td>{{$partner->name}}</td>
                                <td>
                                    <a href="{{asset($partner->image)}}" target="_blank">
                                        <img src="{{asset($partner->image)}}" width="130px" alt="{{$partner->name}}">
                                    </a>
                                </td>
                                <td>
                                    {!! $buttonHelper->deleteButton($masterRoute.'partners.destroy',$partner->id) !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-bold" colspan="2">No Record Found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Add New Partner</h3>
                </div>
                {!! Form::open(['route'=>$masterRoute.'partners.store','method'=>'POST','files'=>true]) !!}
                <div class="box-body">
                    <div class="form-group @error('name') has-error @enderror">
                        {!! Form::label('partner_name') !!}
                        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Partner Name','required']) !!}
                    </div>


                    <div class="form-group @error('image') has-error @enderror">
                        {!! Form::label('partner_image') !!}
                        {!! Form::file('image',['class'=>'form-control','required']) !!}
                    </div>
                </div>
                <div class="box-footer">
                    <button class="btn btn-flat btn-default pull-left" type="reset">
                        <i class="fa fa-undo"></i>Reset
                    </button>
                    <button type="submit" class="btn btn-flat btn-primary pull-right">
                        <i class="fa fa-save"></i>
                        Submit
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

