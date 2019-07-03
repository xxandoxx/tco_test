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
    @if($item['status']==1)
        <div class="col">
            <form method="POST" action="{{ route('task.update',$item['id']) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group row">
                    <label for="developer" class="col-md-3 col-form-label text-md-right">{{ __('Developer') }}</label>
                    <div class="col-md-6">
                        <select class="form-control" id="developer" name="developer">
                            <? $dev = array_column($item['assign'], 'developer_id') ?>
                            @foreach($developers as $developer)
                                <option @if(in_array($developer['id'],$dev)) disabled
                                        @endif value="{{$developer['id']}}">{{$developer['name']}}</option>
                            @endforeach
                        </select>
                        @error('developer')
                        <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                        @enderror
                    </div>
                    <div class="col-md">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Assign') }}
                        </button>
                    </div>
                </div>

                <div class="form-group ">

                </div>
            </form>
        </div>

    @endif
</div>
