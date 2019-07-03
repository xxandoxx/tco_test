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
    {{--@dd($list,$listFree)--}}
    <div class="container">
        <a class="btn btn-info" href="{{ url('manager/task/create') }}">Create</a>
        <div class="row">
            <div class="col-12 col-sm-6 text-center">
                <h3>Task</h3>
                @foreach ($list as $item)
                    @include('manager.task.index_card', ['item' => $item,'status'=>$status,'developers'=>$developers ])
                @endforeach
            </div>
            <div class="col-12 col-sm-6 text-center">
                <h3>Free Task</h3>
                @foreach ($listFree as $item)
                    @include('manager.task.index_card', ['item' => $item,'status'=>$status,'developers'=>$developers])
                @endforeach
            </div>
        </div>
    </div>



@endsection
