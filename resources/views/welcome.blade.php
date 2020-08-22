@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card border-0">
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <input name="nombre" class="form-control border-0" type="text" placeholder="Ingrese la Categoría">
                    </div>
                    <div class="card-footer">
                        <input type="submit" id="btn-guardar" value="Publicar" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection