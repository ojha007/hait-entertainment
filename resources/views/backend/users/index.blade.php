@extends('backend.master')
@section('title_postfix')
    | Users
@endsection
@section('header')
    Users
@endsection
@section('subHeader')
    List
@endsection
@section('content')
    @include('backend.users.modal')
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">Advanced Filter</h3>
        </div>
        {!! Form::open(['route'=>$routePrefix.'users.index','method'=>'GET']) !!}
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('select_role') !!}
                        {!! Form::select('role_id',$roles,request('role_id'),['class'=>'form-control select2','placeholder'=>'Select Role']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-primary btn-flat btn-md" type="submit">
                <i class="fa fa-filter"></i>
                Filter
            </button>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">
                All Users are listed here.
            </h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @inject('buttonHelper','App\Services\TableButtonService')
                @forelse($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{ucfirst($user->role->name)}}</td>
                        <td>{!! spanByStatus($user->status) !!}</td>
                        <td>
                            {!! $buttonHelper->editButtonModal($user->id,'user-modal') !!}
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            let modal = $('#user-modal');
            $('.edit-button').on('click', function () {
                let id = $(this).data('id');
                let url = window.location + '/' + id;
                let method = '{{method_field('patch')}}';
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function (res) {
                        let data = res.data;
                        console.log(data);
                        console.log(modal);
                        modal.find('#email').val(data.email);
                        modal.find('#name').val(data.name);
                        modal.find('#phone').val(data.phone);
                        modal.find('form').attr('action', url);
                        modal.find('form').append(method)
                    }, error: function (err) {
                        console.log(err);
                        alert('Something went wrong');
                    }
                })
            });
            modal.on('hide.bs.modal', function () {
                modal.find('form').attr('action', window.location)
                modal.find('input[name="_method"]').remove();
                modal.find('input[type="text"]').val('');

            });
        })
    </script>
@endpush

