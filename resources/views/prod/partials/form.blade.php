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

    @foreach($categories::categories() as $index => $category)
    <option value="{{ $category->id }}">{{ $category->nome_cat }}</option>
       @endforeach

    </select>
    <label for="category_id">Categoria</label>
</div>

<div class="form-floating-group">
    <input type="file" class="file" name="file">
</div>

<button type="submit" class="comprar" style="width:100%; padding:10px; margin-top:10px;">
    {{ $produto->id ? 'Editar' : 'Cadastrar' }}
</button>

<style>
    input[type="file"]::file-selector-button{
        justify-content: center;
        background: rgb(190, 190, 190) !important;
        background: linear-gradient(45deg, rgba(150, 150, 150) 0%, rgba(200, 200, 200) 50%, rgba(220, 220, 220) 100%) !important;
        border-radius: 2px;
        padding: 10px;
        color: white !important;
        border: none;
    }
</style>