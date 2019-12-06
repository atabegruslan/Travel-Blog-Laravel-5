<div class="row">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Place</th>
                <th>Comments</th>
                <th>User</th>
                <th>Time</th>
            </tr>
        </thead>

        <tbody>
    	    @foreach($param as $k => $v)
    	    	<tr>
                    <td>
                        <img src="{{ $v->img_url }}" class="img-responsive small" alt="{{ $v->place }}">
                    </td>
                    <td><b>{{ link_to_route('entry.show', $v->place, [ $v->id ] ) }}</b></td>
                    <td>{!! $v->comments !!}</td>
                    <td>{!! $v->user->name !!}</td>
                    <td>{!! date('Y-m-d h:i:s', strtotime($v->time) ) !!}</td>
    	    	</tr>
    	    @endforeach
        </tbody>
    </table> 
</div>

<div class="row" >
    <div id="paginate">
        {{ $param->links() }}
    </div>
</div>