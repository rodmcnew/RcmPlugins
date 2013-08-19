var RcmOldLogin = function(instanceId, errors) {

    /**
     * Always refers to this object unlike the 'this' JS variable;
     * @type {RcmOldLoginLink}
     */
    var me = this;

    /**
     * Plugin container div jQuery object
     * @type {jQuery}
     */
    var container = rcm.getPluginContainer(instanceId);

    var loginButton;

    var errorDiv = container.find('div.error');

    me.init = function() {

        //Allow edit script to grab this object
        if(typeof window['RcmOldLogin'] == 'undefined'){
            window['RcmOldLogin']=[];
        }
        window['RcmOldLogin'][instanceId]=me;

        loginButton = container.find('button.login');

        container.find('form').submit(me.login);

        loginButton.click(me.login);

        if (typeof(rcm) === 'object') {
            var urlParams = rcm.getUrlParams();

            if (urlParams['RcmOldLoginError']) {
                window['RcmOldLoginMgr'].processError(
                    urlParams['RcmOldLoginError'],
                    me.handleLoginFail
                );
            }
        }
    };

    me.getErrors = function(){
        return errors;
    };

    me.handleLoginFail = function(error){
        errorDiv.html(errors[error]);
        errorDiv.show();
        me.hideProcessing();
    };

    me.login = function() {
        if(!loginButton.hasClass('disabled')){
            errorDiv.hide();
            me.showProcessing();
            window['RcmOldLoginMgr'].doLogin(
                container.find('input.username').val(),
                container.find('input.password').val(),
                me.handleLoginFail
            );
        }
        return false;//Prevent form submission
    };

    me.showProcessing = function(){
        loginButton.append(
            '<img class="processingSpinner" ' +
                'src="/modules/rcm/images/busy-spinner-16x16.gif" ' +
                'width="16" ' +
                'height="16">'
        );
        loginButton.addClass('disabled');

    };

    me.hideProcessing = function(){
        container.find('.processingSpinner').remove();
        loginButton.removeClass('disabled');
    };

    me.init();
};

