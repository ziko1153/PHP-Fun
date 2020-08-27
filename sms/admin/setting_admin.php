<?php
include 'inc/header.php';?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Admin Setting</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.php">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Admin</span></li>
                <li><span>Setting</span></li>
            </ol>

            <a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>


    <div class="container">
        <input style="display: none" id="login_ip" type="" name="" value="">
        <h2 style="text-align: center;font-size: 60px;">Admin Panel Setting</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#email">Email Setting</a></li>
            <li><a data-toggle="tab" href="#sms">SMS Setting</a></li>
            <li><a data-toggle="tab" href="#admin">Username/Password</a></li>
            <li><a data-toggle="tab" href="#theme">Theme Change</a></li>
            <li><a data-toggle="tab" href="#database">Database Backup</a></li>
            <li><a data-toggle="tab" href="#format">Format</a></li>
        </ul>

        <div class="tab-content">

            <!-- Email Setting  -->
            <?php

$query = "select * from tbl_emailset where id = 2";

$result = $db->select($query);
if ($result) {
    while ($row = mysqli_fetch_array($result)) {

        ?>
            <div id="email" class="tab-pane fade in active">
                <h3>Email Setting</h3>
                <div id="radio_smtp" class="form-group">
                    <input id="smtp" type="radio" name="">SMTP Secure
                    <input id="non-smtp" type="radio" name="" checked>Non-SMTP Secure
                </div>
                <div style="display:none" id="email_show">
                    <div class="row form-horizontal">

                        <div class="form-group">

                            <label class="control-label col-sm-2" for="">Host Name:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="host" value="<?=$row['host'];?>">
                            </div>
                            <label class="control-label col-sm-2" for="">User Name:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="username" value="<?=$row['username'];?>">
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-sm-2" for="email_pass">Password:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="email_pass" value="<?=$row['password'];?>">
                            </div>
                            <label class="control-label col-sm-2" for="smtp_secure">SMTP Secure:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="smtp_secure"
                                    value="<?=$row['smtp_secure'];?>">
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-sm-2" for="port">Port:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="port" value="<?=$row['port'];?>">
                            </div>
                            <label class="control-label col-sm-2" for="from_email">From Email:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="from_email"
                                    value="<?=$row['from_email'];?>">
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-sm-2" for="reply_email">Reply Email:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="reply_email"
                                    value="<?=$row['reply_email'];?>">
                            </div>
                            <label class="control-label col-sm-2" for="from_name">Form Name:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="from_name" value="<?=$row['from_name'];?>">
                            </div>

                        </div>
                        <div class="form-group">

                            <label class="control-label col-sm-2" for="reply_name">Reply Name:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="reply_name"
                                    value="<?=$row['reply_name'];?>">
                            </div>


                        </div>

                    </div>
                </div>
                <div class="row form-horizontal">
                    <div class="form-group pull-left">
                        <div style="margin-left: 230px;margin-top:20px;">
                            <button id="update_email" type="submit" class="btn btn-success"
                                name="update">Update</button>

                        </div>
                    </div>
                </div>
            </div>


            <?php }}?>
            <!-- Company Design Part -->

            <div id="sms" class="tab-pane fade">
                <h3>SMS Setting</h3>
                <div class="row form-horizontal">

                    <div class="form-group">

                        <label class="control-label col-sm-2" for="mobile">Mobile No.:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="mobile" value="">
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="control-label col-sm-2" for="sms_pass">Password:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="sms_pass" value="">
                        </div>

                    </div>


                    <div class="form-group pull-left">
                        <div style="margin-left: 230px;">
                            <button type="submit" class="btn btn-success" name="update">Update</button>

                        </div>
                    </div>


                </div>
            </div>


            <!-- User name and Password DesigPart -->

            <div id="admin" class="tab-pane fade">
                <h3 style="color: orange;"><b>User Name and Password Setting</b></h3>
                <div class="row form-horizontal">

                    <div class="form-group">

                        <label class="control-label col-sm-2" for="user_name">Select User:</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="user_name" name="user_name">
                                <option value="-101">Admin</option>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-sm-2" for="admin_user">New Username:</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="admin_user" value="">
                        </div>

                    </div>

                    <div class="form-group ">

                        <label class="control-label col-sm-2" for="new_pass">New Password:</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control passwordfield" id="new_pass" name="new_pass"
                                value="">

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label col-sm-2" for="con_pass">Confirm Password:</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control passwordfield" id="con_pass" name="con_pass"
                                value="">


                        </div class="col-sm-2">
                        <button class="btn btn-default reveal"><span
                                class="glyphicon glyphicon-eye-open"></span></button>
                    </div>




                    <div class="form-group pull-left">
                        <div style="margin-left: 230px;">
                            <button type="submit" class="btn btn-default btn-warning"
                                id="user_pass_create">Create</button>

                        </div>
                    </div>


                </div>
            </div>

            <div id="theme" class="tab-pane fade">
                <div class="">
                    <marquee>
                        <h3 style="color: black;"><b>Theme Under Construction!!Get Next Update V.2.0 </b></h3>
                    </marquee>
                </div>
            </div>

            <div id="print" class="tab-pane fade">
                <marquee>
                    <h3 style="color: black;"><b> Print Under Construction!!Get Next Update V.2.0 </b></h3>
                </marquee>
            </div>

            <div id="database" class="tab-pane fade">
                <marquee>
                    <h3 style="color: black;"><b> Database Under Construction!!Get Next Update V.2.0 .....</b></h3>
                </marquee>


                <button id="backup_database" name="back_up" class="btn btn-danger">Backup Database </button>



            </div>
            <div id="format" class="tab-pane fade">


                <button id="clear_database" class="btn btn-danger">Clear All Database </button>
            </div>

        </div>
    </div>
</section>




<?php include 'inc/footer.php';?>

<script type="text/javascript">
$('#smtp').click(function() {

    $('#email_show').show();
    $('#smtp').attr('checked', true);
    $('#non-smtp').attr('checked', false);

});
$('#non-smtp').click(function() {

    $('#email_show').hide();

    $('#smtp').attr('checked', false);
    $('#non-smtp').attr('checked', true);

});





$(document).ready(function() {

    $.getJSON('https://ipinfo.io/json', function(data) {
        //console.log(JSON.stringify(data, null, 2));
        $('#login_ip').val(data.ip);
    });



    function AlertSuccess(t, m) {
        new PNotify({
            title: t,
            text: m,
            type: 'success',
            shadow: true
        });

    }

    function AlertDanger(t, m) {
        new PNotify({
            title: t,
            text: m,
            type: 'error',
            shadow: true
        });

    }



    function AlertWarning(t, m) {
        var notice = new PNotify({
            title: t,
            text: m,
            addclass: 'click-2-close',
            hide: true,
            buttons: {
                closer: false,
                sticker: false
            }
        });

        notice.get().click(function() {
            notice.remove();
        });
    }

    // ===================================
    // Show password
    // =================================

    $(".reveal").mousedown(function() {
        $(".passwordfield").attr('type', 'text');
    }).mouseup(function() {
        $(".passwordfield").attr('type', 'password');
    }).mouseout(function() {
        $(".passwordfield").attr('type', 'password');
    });




    // ========================================
    // Username password Create
    // ======================================
    //

    $('#user_pass_create').click(function() {


        var user_id = $('#user_name').val();
        var user_name = $('#admin_user').val().trim();
        var new_pass = $('#new_pass').val();
        var con_pass = $('#con_pass').val();
        var ip = $('#login_ip').val();


        if (user_name.trim() == "") {
            AlertWarning('User Name', 'Please Enter Your Username');
            return;
        } else if (new_pass.length < 6) {
            AlertWarning('Length', 'Your Password at least Contain 6 Character');
            return;
        } else if (con_pass != new_pass) {
            AlertWarning('Didn\'t Match', 'Sorry Confirm Password Not Match');
            return;
        }

        var data = {
            "createUserPass": true,
            "user_id": user_id,
            "user_name": user_name,
            "login_ip": ip,
            "new_pass": new_pass


        }

        $.ajax({
            url: 'autoajax.php',
            method: "POST",
            data: data,
            success: function(response) {
                console.log(response);
                var res = jQuery.parseJSON(response);
                if (res.code == "1") {
                    AlertDanger(res.error, res.message);




                } else {

                    AlertSuccess('Success', res.message);


                    //alert(response);
                }
            },
            error: function() {
                AlertDanger('Operation Failed', 'Sorry Ajax Problem');
            }
        });


    });

    // ========================================
    // Email Setting Update
    // ======================================
    //

    $('#update_email').click(function() {

        if ($("#smtp").is(":checked")) {
            var status = 1;

        } else {
            var status = 0;

        }


        var host = $('#host').val();
        var username = $('#username').val();
        var from_email = $('#from_email').val();
        var email_pass = $('#email_pass').val();
        var smtp_secure = $('#smtp_secure').val();
        var port = $('#port').val();
        var reply_email = $('#reply_email').val();
        var from_name = $('#from_name').val();
        var reply_name = $('#reply_name').val();


        var data = {
            "UpdateEmail": true,
            "host": host,
            "from_email": from_email,
            "username": username,
            "email_pass": email_pass,
            "smtp_secure": smtp_secure,
            "port": port,
            "reply_email": reply_email,
            "from_name": from_name,
            "reply_name": reply_name,
            "status": status



        }

        $.ajax({
            url: 'autoajax.php',
            method: "POST",
            data: data,
            success: function(response) {
                var res = jQuery.parseJSON(response);
                if (res.code == "1") {
                    AlertDanger(res.error, res.message);




                } else {

                    AlertSuccess('Success', res.message);


                    //alert(response);
                }
            },
            error: function() {
                AlertDanger('Operation Failed', 'Sorry Ajax Problem');
            }
        });





    });



});
</script>