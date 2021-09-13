let Users = {
    grantRoleBtn: null,

    init: function () {
        this.grantRoleBtn = $('.btn-grant-role');
        this.bindClickGrantRoleBtn();
    },

    bindClickGrantRoleBtn: function () {
        this.grantRoleBtn.on('click', function () {
            let btn = $(this);
            let url = $(this).attr('data-url');
            let userId = $(this).attr('data-user-id');

            let csrf = $(`meta[name='csrf-token']`).attr('content');

            let hasRole = $(this).attr('data-hasrole');
            let action = hasRole == '1' ? 'revoke' : 'grant';

            let options = {
                url: url,
                method: 'POST',
                data: {'user_id': userId, 'action': action},
                headers: {
                    'x-csrf-token': csrf
                },
                success: function (data) {
                    if (data.success) {
                        switch (action) {
                            case 'grant':
                                btn.attr('data-hasrole',1);
                                btn.attr('title','Revoke content creator role');
                                btn.removeClass('btn-warning').addClass('btn-danger');
                                break;
                            case 'revoke':
                                btn.attr('data-hasrole',0);
                                btn.attr('title','Grant content creator role');
                                btn.addClass('btn-warning').removeClass('btn-danger');
                                break;
                        }
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                }
            };

            $.ajax(options);
        });
    }
};

window.Users = Users;
