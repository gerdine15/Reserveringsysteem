$("#changeUserRoleModal").on('shown.bs.modal', function (e) {
    $.ajax({
        type : 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        url : "/user/"+$(e.relatedTarget).attr('name'),
        success:function(data){
            $("#userName").val(data.name);
            $("#roles_id").val(data.role_id);
            $("#changeUserRoleBtn").attr('name', data.id);
        },
        error:function(data) {
            //
            console.log(data);
        }
    });
});


$("#changeUserRoleBtn").on('click', function (e) {
    $.ajax({
        type : 'PUT',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        url : "/user/"+$('#changeUserRoleBtn').attr('name'),
        data:{
            'role_id':  $("#roles_id").val(),
        },
        success:function(data){
            $('#changeUserRoleModal').modal('hide');
            $('.warning').addClass('d-none');
            window.location.reload();
        },
        error:function(data) {
            console.log(data);
        }
    });
});
