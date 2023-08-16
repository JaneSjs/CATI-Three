<h4>The following quota criteria have been met.</h4>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            @foreach($field_values as $criteria)
                <tr>
                  <th>{{ $criteria['field'] }}</th>
                  <th>{{ $criteria['value'] }}</th>
                </tr>
            @endforeach
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
