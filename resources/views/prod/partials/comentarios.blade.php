<div class="container">
    <div class="row justify-content-center" style="margin-top:20px;">
        <div class="col-10">
            @if(auth()->check())
            <div class="card">
                <div class="card-body">
                    <label><b>Comente</b></label>
                    <form method="post" action="produto/comentar/{{$produto->id}}">
                        @csrf
                        <textarea class="form-control" name="comentario" value="{{ old('comentario') }}"></textarea>
                        <button class="btn btn-success" style="margin-top:5px;">Enviar comentário</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-10" style="margin-top:20px;">
            <div class="card">
                <div class="card-body">
                    <h4><b>Comentários de usuários</b></h4>
                    <hr />
                    @if($comentarios->count() > 0)
                    @foreach($comentarios as $index => $comentario)
                    <div class="row">
                        <div class="col-12">
                            <b>{{$comentario->user->name}}</b><i class="text-muted"> {{date('d/m/Y',strtotime($comentario->created_at))}}</i><br/>
                                <p id="paragrafo" class="paragrafo" value="{{$comentario->id}}">{{$comentario->comentario}}</p>
                                @if(auth()->check() && $comentario->comentario_usuario_id == auth()->user()->id)
                                    <form method="post" action="/produto/comentar/delete/{{$comentario->id}}">
                                    @method('delete')
                                    @csrf
                                    <button
                                    type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir?');"
                                    style="margin-top:8px;">
                                    <i class="bi bi-trash-fill"></i>
                                    </button>
                                    </form>
                                    
                                    <button 
                                    class="btn btn-primary"
                                    id="edit" 
                                    value="{{$comentario->id}}" 
                                    name="editar">
                                    <i class="fas fa-pen"></i>
                                    </button>
                            @endif
                            @if($index < $comentarios->count()-1)
                            <hr/>
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="col">
                        <p class="text-center">Nenhum comentário encontrado.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
        let input = document.createElement('input');
        input.className = 'form-control';
        input.type = 'text';

    $('button[name="editar"]').on('click', function(){ 
        let botao = $(this); // Pega o botão clicado
        let valorBotao = botao.val(); // Obtém o valor do botão
        let paragrafo = botao.closest('.row').find('p.paragrafo');
        
        let textoParagrafo = paragrafo.text();
        input.value = textoParagrafo;
        
        let formularioAction = `/produto/show/comentario/${valorBotao}`;

        let html = `
        <form method="post" action="${formularioAction}">
            @csrf
            @method("put")
            <textarea name="comentario" class="form-control" value="${textoParagrafo}">${textoParagrafo}</textarea>
            <button type="submit" class="btn btn-success" name="submit" value="${valorBotao}" style="margin-top:8px;">Alterar</button>
        </form>
        `;
        paragrafo.replaceWith(html);
    });
});
</script>