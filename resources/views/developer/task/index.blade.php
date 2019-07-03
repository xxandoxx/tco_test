@extends('layouts.app')
@section('content')
    {{--@dd($list)--}}
    <div class="container">

        <div class="row">
            <div class="col-12 col-sm-6 text-center">
                <h3>Task List</h3>
                @foreach ($list as $item)
                    @include('developer.task.index_card', ['item' => $item,'status'=>$status,'developers'=>$developers ])
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('form.developerUpdate').on("submit", function (e) {
                e.preventDefault();
                const form = $(this);
                let action = form.attr('action');
                let id = form.attr('id').slice(5, form.attr('id').length);
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: form.serialize(),
                    success: function (data) {
                        // console.log(data, id);
                        $('h6#status_' + id).text(data);
                    }
                });
            });
        });
    </script>
@endsection
