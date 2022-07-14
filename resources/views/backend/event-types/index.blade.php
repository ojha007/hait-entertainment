@extends('backend.master')
@section('title_postfix')
    | Event Category
@endsection
@section('header')
    Master
@endsection
@section('subHeader')
    Event Category
@endsection
@section('content')
    @include('backend.event-types.modal')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">
                All type of events are listed .
            </h3>
            <div class="box-tools pull-right">
                <div class="btn btn-flat btn-sm btn-primary pull-right" data-toggle="modal"
                     data-target="#event-modal" type="button">
                    <i class="fa fa-plus-circle"></i>
                    Add Event Category
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @inject('buttonHelper','App\Services\TableButtonService')
                @forelse($eventTypes as $type)
                    <tr>
                        <td>{{$type->name}}</td>
                        <td>
                            {!! $buttonHelper->editButtonModal($type->id,'event-modal') !!}
                            {!! $buttonHelper->deleteButton($masterRoute.'event-types.destroy',$type->id) !!}
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
            let modal = $('#event-modal');
            $('.edit-button').on('click', function () {
                let id = $(this).data('id');
                let url = window.location + '/' + id;
                let method = '{{method_field('patch')}}';
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function (res) {
                        modal.find('input[type="text"]').val(res.data.name);
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
