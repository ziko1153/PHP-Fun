<!DOCTYPE html>
<html>

<head>
    <title>Feedback</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/moment-timezone-with-data.js"></script>
</head>



<!-- Page Styles -->
<style type="text/css">
body {
    /*background-color: #c5cae9;
		color: #000;*/
}

#myInput {
    margin-left: 5px;
    color: black;
}
</style>



<hr>


<body>

    <div style="margin:20px">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h2><u>আপনার যা ইচ্ছা তাই লিখেন</u></h2>
                <h2><u>Write Whatever You Want</u></h2>
            </div>
        </div>
        <br>


        <div class="row">
            <div class="col-sm-offset-2 col-sm-6">
                <p id="ip" style="display: none;"></p>
                <p id="city" style="display: none;"></p>
                <p id="country_name" style="display: none;"></p>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="">খারাপ মন্তব্য /Negative Comment:</label>

                        <div class="col-sm-9 ">
                            <textarea class="form-control" rows="5" id="negative"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="">ভালো মন্তব্য /Postive Comment:</label>
                        <div class="col-sm-9 ">
                            <textarea class="form-control" rows="5" id="positive"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button id="submit" name="submit" type="submit"
                                class="btn btn-info btn-lg btn_full">Submit</button>
                        </div>
                    </div>

                </div>
            </div>





        </div>



        <br>
    </div>

</body>

</html>











<script type="text/javascript">
function get_browser_info() {
    var ua = navigator.userAgent,
        tem, M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
    if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return {
            name: 'IE ',
            version: (tem[1] || '')
        };
    }
    if (M[1] === 'Chrome') {
        tem = ua.match(/\bOPR\/(\d+)/)
        if (tem != null) {
            return {
                name: 'Opera',
                version: tem[1]
            };
        }
    }
    M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
    if ((tem = ua.match(/version\/(\d+)/i)) != null) {
        M.splice(1, 1, tem[1]);
    }
    return {
        name: M[0],
        version: M[1]
    };
}





$(document).ready(function() {

    $.get('https://ipapi.co/json/', function(res) {
        $('#ip').html(res.ip);
        $('#city').html(res.city);
        $('#country_name').html(res.country_name);

    });

});


///Select for Cash and bank and show total amount



$("#submit").click(function(e) {

    var ip = $('#ip').text();
    var city = $('#city').text();
    var country_name = $('#country_name').text();
    console.log(ip, city, country_name);
    var negative = $("#negative").val();
    negative = negative.trim();
    var positive = $("#positive").val();
    poslength = $("#positive").val().length;
    neglength = negative.length;

    if (negative == '') {
        alert("খারাপ মন্তব্য  লিখবেন না? \n Please Write Some Bad Comments About me");
    } else if (positive == '') {
        alert("ভালো মন্তব্য  লিখবেন না? \n Pleasee Write Some Goodd Coomments About me");
    } else if (neglength < 50) {
        alert("খারাপ মন্তব্য  একটু বেশি লিখেন : " + neglength + "< 50 \n\n Write More Bad Comments : " +
            neglength +
            "< 50");
    } else {

        var browser = get_browser_info();
        var bro_name = browser.name;
        var bro_ver = browser.version;
        var timezone = moment.tz.guess();

        var data = {
            "positive": positive,
            "negative": negative,
            "bro_name": bro_name,
            "bro_ver": bro_ver,
            "timezone": timezone,
            city,
            country_name,
            "ip": ip
        }

        $.ajax({
            url: "sus.php",
            method: "POST",
            data: data,
            success: function(response) {
                if (response == 'success') {
                    $("#negative").val("");
                    $("#positive").val("");

                    window.location.replace("welcome.php");
                } else {
                    alert("Something went Wrong with You or Me ");
                }

                //window.location.reload("index.php");
                //alert(response);

            },
            error: function(jqXHR) {
                console.log(jqXHR);
                alert("Internal Server Problem.I will Fix It Don't worry !!");
            }
        });

    }




});
</script>



</html>