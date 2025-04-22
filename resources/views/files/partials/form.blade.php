<form method="post" enctype="multipart/form-data" action="/files">
    @csrf
    <input type="hidden" name="produto_id" value="{{$produto->id}}">
    <input type="file" name="file">
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<div class="row" style="margin:4px;">
    <a href="/produto/edit/{{$produto->id}}" class="btn btn-primary"
        style="margin-top:8px; height:100%; margin-right:8px;">
        <i class="fas fa-pen"></i>
    </a>
    <form method="post" action="/produto/{{$produto->id}}">
        @method('delete')
        @csrf
        <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?');"
            style="margin-top:8px;"><i class="fas fa-trash"></i></button>
    </form>
</div>