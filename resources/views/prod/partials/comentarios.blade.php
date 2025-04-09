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
                                {{$comentario->comentario}}
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