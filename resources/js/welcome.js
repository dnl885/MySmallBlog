let Welcome = {

    LogInSignUpBtn: null,
    LogInSignUpOverlay: null,
    LogInSignUpOverlayCloseBtn: null,
    LogInSignUpTab: null,
    LogInSignUpSubmitBtn: null,
    ActiveTab:null,
    EmailVerificationModal: null,

    init: function () {
        this.LogInSignUpBtn = $('.btn-login-signup');
        this.LogInSignUpOverlayCloseBtn = $('.close-overlay');
        this.LogInSignUpOverlay = $('.overlay');
        this.LogInSignUpTab = $('.tab');
        this.LogInSignUpSubmitBtn = $('.btn-submit');
        this.ActiveTab =  $('.login-screen');
        this.EmailVerificationModal = $('.bd-verification-modal-sm');
        this.bindOverlayClickActions();
        this.showEmailVerifiedModal();
    },

    showEmailVerifiedModal: function (){
        if(this.EmailVerificationModal.length) {
            this.EmailVerificationModal.modal();
        }
    },

    appendValidationErrorsToInput: (ctx,errors)=>{
        ctx.ActiveTab.find('input').removeClass('is-invalid');
        ctx.ActiveTab.find('input').siblings('.is-invalid-message').remove();

        for(const [key,value] of Object.entries(errors)){
            let inputClass = `input[name="${key}"]`;

            let input =  ctx.ActiveTab.find(inputClass);

            input.addClass('is-invalid');

            input.parent().append(`<div class="is-invalid-message">${value}</div>`);
        }
    },

    bindOverlayClickActions: function () {
        let self = this;

        let showIcons = function (){
            let iconToShowClass = ".icon-"+$(this).attr('name');

            let activeScreen = $('.'+self.ActiveTab.attr('class'));

            activeScreen.find('.icon').hide();

            activeScreen.find(iconToShowClass).show();
        };

        this.LogInSignUpBtn.on('click', function (e) {
            e.preventDefault();

            self.LogInSignUpOverlay.fadeIn();

            $('body').addClass('no-scroll');
        });

        this.LogInSignUpOverlayCloseBtn.on('click', function () {
            self.LogInSignUpOverlay.fadeOut();

            $('body').removeClass('no-scroll');
        });

        this.LogInSignUpTab.on('click', function () {
            let toInactivate = $(this).siblings();
            let toActivate = $(this);

            toInactivate.removeClass('tab-active').addClass('tab-inactive');
            toActivate.removeClass('tab-inactive').addClass('tab-active');

            let screenToShowD = toActivate.attr('data-screen');
            let screenToHideD = toInactivate.attr('data-screen');

            let activeTabInput = self.ActiveTab.find('input');

            activeTabInput.off('focus');

            activeTabInput.removeClass('is-invalid');

            activeTabInput.siblings('.is-invalid-message').remove();

            activeTabInput.not(':input[type=submit], :input[type=hidden]').val("");

            self.ActiveTab.find('.icon').hide();

            self.ActiveTab = $('.'+toActivate.attr('data-screen'));

            self.ActiveTab.find('input').not(':input[type=submit]').on('focus',showIcons)

            $(`.${screenToHideD}`).hide();
            $(`.${screenToShowD}`).show();
        });

        this.LogInSignUpSubmitBtn.on('click', function (e) {
            e.preventDefault();
            let $form = $(this).closest('form');
            let url = $form.attr('action');
            let data = $form.serialize();
            let button = $(this);

            let settings = {
                'url':url,
                'method':'POST',
                'data':data,
                'beforeSend':function (){
                    button.addClass('button-disabled');
                    button.prop('disabled',true);
                },
                'error': function (xhr){
                    let respJson = xhr.responseJSON;

                    button.removeClass('button-disabled');
                    button.prop('disabled',false);

                    if(respJson) {
                        self.appendValidationErrorsToInput(self, respJson.errors);
                    }
                },
                'success':function (resp){
                    if(resp.success){
                        location.href = resp.redirect;
                    }
                }
            };

            $.ajax(settings);
        });

        this.ActiveTab.find('input').not(':input[type=submit]').on('focus',showIcons);
    }
};

window.Welcome = Welcome;
