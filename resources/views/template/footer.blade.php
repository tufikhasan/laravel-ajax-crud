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
            console.log(name, address, id, phone, email);


        })
    });
</script>
</body>

</html>
