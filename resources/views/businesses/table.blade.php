<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="businesses-table" aria-label="businessTable">
            <thead>
            <tr>
                <th>Business Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Website</th>
                <th>Logo</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($businesses as $business)
                <tr>
                    <td>{{ $business->business_name }}</td>
                    <td>{{ $business->address }}</td>
                    <td>{{ $business->city }}</td>
                    <td>{{ $business->postal_code }}</td>
                    <td>{{ $business->country }}</td>
                    <td>{{ $business->phone }}</td>
                    <td>{{ $business->email }}</td>
                    <td>{{ $business->website }}</td>
                    <td>{{ $business->logo }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['businesses.destroy', $business->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('businesses.show', [$business->id]) }}"
                               class='btn btn-default btn-xs'>
                                <em class="far fa-eye"></em>
                            </a>
                            <a href="{{ route('businesses.edit', [$business->id]) }}"
                               class='btn btn-default btn-xs'>
                                <em class="far fa-edit"></em>
                            </a>
                            {!! Form::button('<em class="far fa-trash-alt"></em>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure?')"
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $businesses])
        </div>
    </div>
</div>
