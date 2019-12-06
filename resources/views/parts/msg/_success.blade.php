@if (Session::has('success'))
    <div class="alert alert-success row">
        {{ Session::get('success') }}
    </div>
@endif