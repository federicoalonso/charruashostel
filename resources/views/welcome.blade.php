@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="row">
        <div class="col-12 mb-4">
        
            <div class="card border-0">
                <categorias-form></categorias-form>
            </div>
        </div>
        <categorias-list></categorias-list>
    </div>
</div>
@endsection