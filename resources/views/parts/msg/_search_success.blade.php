@if (Session::has('search_success'))
    <div class="alert alert-success row">
        {{ Session::get('search_success') }}
    </div>
@endif