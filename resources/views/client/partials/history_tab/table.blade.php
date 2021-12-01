<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Start Time</th>
                            <th>Description</th>
                            <th>Employee</th>
                            <th>Qty</th>
                            <th>Total Price
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                @if(isset($data))
                                    {{ $data }}
                                @else
                                    No Record Found
                                @endif
                                    
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
