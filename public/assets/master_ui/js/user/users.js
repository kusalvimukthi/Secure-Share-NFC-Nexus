let t, a, n;

var e, s = $("#users-table"), o = $(".select2"), i = "app-user-view-account.html", r = {
    1: {
        title: "Pending",
        class: "bg-label-warning"
    },
    2: {
        title: "Active",
        class: "bg-label-success"
    },
    3: {
        title: "Inactive",
        class: "bg-label-secondary"
    }
};
let usersTable;
$(document).ready(function() {
    //data table
    usersTable =  new DataTable('#users-table', {
        processing: true,
        serverSide: true,
        ajax: "/users-data",
        columns: [
            {
                data: null,
            },
            {data: 'id'},
            {data: 'name'},
            {data: 'email'},
            {data: 'nic'},
            {data: 'user_type'},
            {data: 'status'},
            {data: 'action'}
        ],
        createdRow: function(row, data, dataIndex) {
            // Add data-id attribute to the row
            $(row).attr('data-id', data.id);
        },
        columnDefs: [
            {
                targets: 0,
                orderable: !1,
                checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                },
                render: function () {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input" >'
                },
                searchable: !1
            },
        ],
    });

    $(document).on('click', '#openUserEdit', function(e) {
        e.preventDefault();
        let userId = $(this).closest('tr').data('id');
        $('#form-type').val('update');
        $('#user_id').val(userId);
        $('#offcanvasEndLabel').text('Update User');
        $('#customer-submit-btn').text('Update User');
        openUserEditModal(userId);
    });
});

function openUserEditModal(userId) {

    $.ajax({
        url: '/customer/' + userId,
        method: 'GET',
        success: function(response) {
            console.log(response)
            $('#ecommerce-customer-add-name').val(response.name);
            $('#ecommerce-customer-add-email').val(response.email);
            $('#ecommerce-customer-add-contact').val(response.user_detail.tel_no);
            $('#customer-nic').val(response.user_detail.nic);
            $('#defaultSelect').val(response.type);
            $('#customer-add-address').val(response.user_detail.address);
            $('#ecommerce-customer-add-town').val(response.user_detail.town);
            $('#ecommerce-customer-add-state').val(response.user_detail.state);
            $('#ecommerce-customer-add-post-code').val(response.user_detail.post_code);
            if (response.user_detail.status === 'true') {
                $('#status_checkbox').prop('checked', true);
            } else {
                $('#status_checkbox').prop('checked', false);
            }
            $('#offcanvasEnd').offcanvas('show');
        }
    });
}

$('#create_customer').on('submit', function (e) {
    e.preventDefault();
    if ($(this).valid()) {
        let formData = new FormData(this);
        let formType = $('#form-type').val();

        $('#customer-submit-btn').prop('disabled', true);
        $('#spinner').show();

        if (formType === 'create') {
            createOrUpdateCustomer(formData, '/create_customer', 'Customer created successfully');
        } else {
            createOrUpdateCustomer(formData, '/update_user', 'Customer updated successfully');
        }

    }
})

function createOrUpdateCustomer(formData, url, msg) {
    let token = $('meta[name="csrf-token"]').attr('content');
    formData.append('_token', token);
    if (formData.has('status')) {
        formData.append('status', 'true');
    } else {
        formData.append('status', 'false');
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#create_customer')[0].reset();
            $('#offcanvasEnd').offcanvas('hide');
            showToast(msg, 'Info', 'bg-success')
            usersTable.ajax.reload();
            $('#form-type').val('create');
            $('#user_id').val('');
            $('#offcanvasEndLabel').text('Create New User');
            $('#customer-submit-btn').text('Create User');

            $('#customer-submit-btn').prop('disabled', false);
            $('#spinner').hide();
        },
        error: function (xhr, status, error) {
            $('#customer-submit-btn').prop('disabled', false);
            $('#spinner').hide();
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;

                $.each(errors, function (key, value) {
                    let errorElement = $('#error-' + key);
                    errorElement.text(value[0]);

                    let inputElement = $('#ecommerce-customer-add-' + key);
                    inputElement.addClass('is-invalid');
                });
            }
        }
    });
}

$('#userDiscard').on('click', function () {
    $('#create_customer')[0].reset();
})

function clearErrors(inputElement) {
    let fieldName = inputElement.attr('name');
    $('#error-' + fieldName).text('');
    inputElement.removeClass('is-invalid');
}

// Attach input event listener to all form controls to clear errors on typing
$('#create_customer input, #customerForm textarea, #customerForm select').on('input', function () {
    clearErrors($(this));
});

//update customer

$(document).ready(function() {
    let urlPath = window.location.pathname;
    let userId = urlPath.split('/')[2];
    let combinedTable = new DataTable('#combined-card-table', {
        processing: true,
        serverSide: true,
        ajax: "/combined-card-list/" + userId, // Replace 'userId' with the actual user ID dynamically
        columns: [
            { data: null },
            { data: 'card_type', title: 'Card Type' }, // New column for card type
            { data: 'name' },
            { data: 'email' },
            { data: 'status' },
            { data: 'action' }
        ],
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                checkboxes: {
                    selectAllRender: '<input type="checkbox" class="form-check-input">'
                },
                render: function() {
                    return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                },
                searchable: false
            },
        ],
    });
});
