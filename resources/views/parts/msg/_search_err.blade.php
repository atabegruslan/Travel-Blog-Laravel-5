@if (Session::has('search_err'))
    <div class="alert alert-danger row">
        {{ Session::get('search_err') }}
    </div>
@endif