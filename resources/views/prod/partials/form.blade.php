<h4 class="text-center">{{!$produto->id ? 'Cadastrar' : 'Editar'}} produto</h4>
<hr>
@csrf

<div class="form-floating-group">
    <input type="text" name="nome_prod" class="input" placeholder=" "
        value="{{ old('nome_prod', $produto->nome_prod) }}" required>
    <label for="nome_prod">Nome</label>
</div>

<div class="form-floating-group">
    <input type="text" name="valor_prod" class="input" placeholder=" "
        value="{{ old('valor_prod', $produto->valor_prod) }}" required>
    <label for="valor_prod">Valor</label>
</div>

<div class="form-floating-group">
    <select name="category_id" class="input">
        <option value="" disabled selected hidden>Selecionar categoria</option>
        @foreach($categories::categories() as $category)
            <option value="{{$category->id}}"  {{ $produto->category_id ? 'selected' : '' }} >{{$category->nome_cat}}</option>
        @endforeach
    </select>
    <label for="category_id">Categoria</label>
</div>
<button type="submit" class="btn btn-success" style="width:100%; padding:10px; margin-top:10px;">
    {{ $produto->id ? 'Editar' : 'Cadastrar' }}
</button>