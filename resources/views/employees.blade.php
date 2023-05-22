@include('template.header');
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title rounded">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Student <b>Managements</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i>
                            <span>Add New Employee</span></a>
                    </div>
                </div>
            </div>
            <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Search employee">
            <div class="table-data">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    SL No:
                                </span>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $value)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        {{ $key + 1 }}
                                    </span>
                                </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->address }}</td>
                                <td>{{ $value->phone }}</td>
                                <td>
                                    <a href="#editEmployeeModal" class="edit" data-toggle="modal"
                                        data-id="{{ $value->id }}" data-name="{{ $value->name }}"
                                        data-email="{{ $value->email }}" data-address="{{ $value->address }}"
                                        data-phone="{{ $value->phone }}"><i class="material-icons" data-toggle="tooltip"
                                            title="Edit">&#xE254;</i></a>
                                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"
                                        data-id="{{ $value->id }}"><i class="material-icons" data-toggle="tooltip"
                                            title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- Both 2 are use for laravel pagination --}}
                {{-- {{ $employees->links() }} --}}
                {!! $employees->links() !!}
            </div>
        </div>
    </div>
</div>
@include('template.add_modal');
@include('template.edit_modal');
@include('template.delete_modal');
@include('template.footer');
