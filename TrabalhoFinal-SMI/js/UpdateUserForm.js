function validateFormUpdateUser() {
    var valid = true;
    var filter =  new RegExp(/^([a-zA-Z0-9-_]{6,})/);
    var filterEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    var alertinfo = "";
    
    if( !filterEmail.test(this.form.email.value) 
            && this.form.email.value !== "") {
        alertinfo += "Invalid Email \n";
        valid = false;
    }
    if( this.form.repEmail.value !== this.form.email.value ) {
        alertinfo += "Emails dont match \n";
        valid = false;
    }
    if( !filter.test(this.form.oldPassword.value) 
            && this.form.oldPassword.value !== "") {
        alertinfo += "Invalid Old Password \n";
        valid = false;
    }
    if( !filter.test(this.form.newPassword.value)
            && this.form.newPassword.value !== "") {
        alertinfo += "Invalid New Password \n";
        valid = false;
    }
    if( this.form.newPassword.value !== this.form.repNewPassword.value ) {
        alertinfo += "Passwords dont match \n";
        valid = false;
    }

    if(valid) {
        return true;
    }else {
        alert(alertinfo);
        return false;
    }
    return true;
}