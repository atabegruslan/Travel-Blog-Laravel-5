<div class="row">
        
    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">

        <table class="table">
            <thead>
                <tr>
                    <th>Place: </th>
                    <th>{{ $param->place }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>By: </strong></td>
                    <td>{{ $param->user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Modified: </strong></td>
                    <td>{{ $param->time }}</td>
                </tr>
            </tbody>
        </table>

        <hr />

        <div>
            <p><strong>Comments: </strong></p>
            <p>{{ $param->comments }}</p>
        </div>

    </div>
        
    <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
        <img src="{{ $param->img_url }}" class="img-responsive medium" alt="{{ $param->place }}">
    </div>

</div>
