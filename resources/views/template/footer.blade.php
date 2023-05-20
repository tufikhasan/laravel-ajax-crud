<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });

        //add Employee ajax
        $(document).on('click', '.add_employee', function(e) {
            e.preventDefault();
            let name, email, address, phone;
            name = $('#name').val();
            email = $('#email').val();
            address = $('#address').val();
            phone = $('#phone').val();

            $.ajax({
                url: "{{ route('add.employee') }}",
                method: "post",
                data: {
                    name: name,
                    email: email,
                    address: address,
                    phone: phone
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#addEmployeeModal").modal('hide');
                        $("#addEmployeeForm")[0].reset();
                        $(".table").load(location.href +
                            ' .table');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append(
                            `<span class="text-danger mb-2">${value}</span><br>`
                        )
                    })
                }
            })
        })

        //show Employee value in edit form
        $(document).on('click', '.edit', function(e) {
            let id, name, email, address, phone;

            id = $(this).data('id');
            name = $(this).data('name');
            email = $(this).data('email');
            address = $(this).data('address');
            phone = $(this).data('phone');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_email').val(email);
            $('#up_address').val(address);
            $('#up_phone').val(phone);
        })

        //update Employee ajax
        $(document).on('click', '.update_employee', function(e) {
            e.preventDefault();
            let up_id, up_name, up_email, up_address, up_phone;
            up_id = $('#up_id').val();
            up_name = $('#up_name').val();
            up_email = $('#up_email').val();
            up_address = $('#up_address').val();
            up_phone = $('#up_phone').val();

            $.ajax({
                url: "{{ route('update.employee') }}",
                method: "post",
                data: {
                    up_id: up_id,
                    up_name: up_name,
                    up_email: up_email,
                    up_address: up_address,
                    up_phone: up_phone
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#editEmployeeModal").modal('hide');
                        $("#updateEmployee")[0].reset();
                        $(".table").load(location.href +
                            ' .table');
                    }
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.updateErrMsgContainer').append(
                            `<span class="text-danger mb-2">${value}</span><br>`
                        )
                    })
                }
            })
        })

        //show Employee id in delete modal form
        $(document).on('click', '.delete', function(e) {
            let id = $(this).data('id');
            $('#del_id').val(id);
        })

        //delete Employee ajax
        $(document).on('click', '.delete_employee', function(e) {
            e.preventDefault();
            let del_id = $('#del_id').val();

            $.ajax({
                url: "{{ route('delete.employee') }}",
                method: "post",
                data: {
                    del_id: del_id,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#deleteEmployeeModal").modal('hide');
                        // $("#updateEmployee")[0].reset();
                        $(".table").load(location.href +
                            ' .table');
                    }
                },
            })
        })

        //add Employee ajax
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            employeePagination(page);
        })

        function employeePagination(page) {
            $.ajax({
                url: "/pagination/paginate-data?page=" + page,
                success: function(res) {
                    $('.table-data').html(res);
                },
            })
        }

        //search Employee ajax
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url: "{{ route('search.employee') }}",
                method: "get",
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('.table-data').html(res);
                    if (res.status == 'not-found') {
                        $('.table-data').html(
                            `<h6 class="text-danger mb-2"><b class="text-dark">${search_string}:- </b> No Employee found</h6>`
                        );
                    }
                },
            })
        })
    });
</script>
</body>

</html>
