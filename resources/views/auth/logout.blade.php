<form action="/logout" method="POST" class="form-inline" 
    style="display:inline-block" id="logout_form">
    @csrf
    <a onclick="document.getElementById('logout_form').submit(); return false;"
        class="font-weight-bold text-white nounderline pr-2 pl-2" href>Sair</a>
</form>