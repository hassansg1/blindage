<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Test 123</td>
                    <td>$12</td>
                    <td><input style="width: 50%" type="number" class="form-control"></td>
                    <td>
                        <button onclick="if(confirm('Are you sure you want to delete?')) $('#delete_'+1).submit()" title="Delete" type="button" class="btn btn-light btn-form btn-no-color dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
