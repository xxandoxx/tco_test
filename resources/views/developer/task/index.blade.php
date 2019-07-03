<?php
/**
 * Created by PhpStorm.
 * User: andranik.kocharyan
 * Date: 03/07/2019
 * Time: 00:41
 */
?>
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



@endsection
