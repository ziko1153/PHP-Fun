<?php include 'inc/head.php';
session::checklogin();
?>

<body>
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <h2 class="logo pull-left">
                Admin Login Panel
            </h2>

            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="form-group mb-lg">
                        <label>Username</label>
                        <div class="input-group input-group-icon">
                            <input id="user_name" type="text" class="form-control input-lg" value="admin" />
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-user"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-lg">
                        <div class="clearfix">
                            <label class="pull-left">Password</label>
                            <!-- <a href="recover_password.php" class="pull-right">Lost Password?</a> -->
                        </div>
                        <div class="input-group input-group-icon">
                            <input id="user_pass" name="pwd" type="password" class="form-control input-lg"
                                value="123456" />
                            <span class="input-group-addon">
                                <span class="icon icon-lg">
                                    <i class="fa fa-lock"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="checkbox-custom checkbox-default">
                                <input id="RememberMe" name="rememberme" type="checkbox" />
                                <label for="RememberMe">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-sm-4 text-right">
                            <button id="submit" type="submit" class="btn btn-primary ">Sign In</button>

                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All Rights Reserved By @ZIKO</p>

            <?php include 'inc/footer.php';?>

            <script type="text/javascript">
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

            function AlertDanger(t, m) {
                new PNotify({
                    title: t,
                    text: m,
                    type: 'error',
                    hide: false,
                    buttons: {
                        sticker: false
                    }
                });
            }

            function AlertSuccess(t, m) {
                new PNotify({
                    title: t,
                    text: m,
                    type: 'success',
                    shadow: true
                });

            }

            $('#submit').click(function() {

                var user_name = $('#user_name').val();
                var user_pass = $('#user_pass').val();


                var data = {
                    "login_check": true,
                    "user_name": user_name,
                    "user_pass": user_pass
                }


                $.ajax({
                    url: 'classes/userlogin.php',
                    method: "POST",
                    data: data,
                    success: function(response) {
                        //alert(response);
                        var res = jQuery.parseJSON(response);
                        if (res.code == "1") {
                            AlertDanger(res.error, res.message);




                        } else {

                            AlertSuccess('Success', res.message);

                            window.setTimeout(function() {
                                window.location.href = "dashboard.php"
                            }, 1000);
                            //alert(response);
                        }
                    },
                    error: function() {
                        AlertDanger('Error', 'Ajax Failed To Get Data');
                    }
                });



            });
            </script>