@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('To Do List Based on Laravel 10 and Vue 3') }}</div>

                <div class="card-body">


                    <todo-list  > </todo-list>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
