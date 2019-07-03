<?php
/**
 * Created by PhpStorm.
 * User: andranik.kocharyan
 * Date: 03/07/2019
 * Time: 12:14
 */

?>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{$item['title']}}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{date('d-m-Y', strtotime($item['deadline']))}}</h6>
        <h6 class="card-subtitle mb-2 text-muted">{{$status[$item['status']]}}</h6>
        <p class="card-text">{{$item['description']}}</p>
        @if(!empty($item['assign']))
            <div>
                <h6>Developer(s)</h6>
                {{--@dd($item,$developers)--}}
                @foreach ($item['assign'] as $assign)
                    <span class="text-black-50">{{$developers[$assign['developer_id']]['name']}}</span><br>
                @endforeach
            </div>

        @endif
    </div>

    <div class="col">
        <form method="POST" action="{{ route('task.update',$item['id']) }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="form-group row">
                <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Status') }}</label>
                <div class="col-md-6">
                    <select class="form-control" id="status" name="status">
                        @foreach($status as $key => $val)
                            <option @if($key == $item['status']) disabled
                                    @endif value="{{$key}}">{{$val}}</option>
                        @endforeach
                    </select>
                    @error('status')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                    @enderror
                </div>
                <div class="col-md">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Change') }}
                    </button>
                </div>
            </div>

            <div class="form-group ">

            </div>
        </form>
    </div>

</div>
