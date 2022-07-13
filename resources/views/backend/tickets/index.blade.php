@extends('backend.master')
@section('title_postfix')
    | Ticket
@endsection
@section('header')
    Master
@endsection
@section('subHeader')
    Ticket
@endsection
@section('content')
    @include('backend.tickets.modal')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">
                All Ticket are listed.
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
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @inject('buttonHelper','App\Services\TableButtonService')
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{$ticket->name}}</td>
                        <td>
                            {!! $buttonHelper->editButtonModal($ticket->id,'ticket-modal') !!}
                            {!! $buttonHelper->deleteButton($masterRoute.'tickets.destroy',$ticket->id) !!}
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
            let modal = $('#ticket-modal');
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
