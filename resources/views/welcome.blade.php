<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <input name="nombre" type="text">
    <input type="submit" id="btn-guardar" value="Publicar">
</form>