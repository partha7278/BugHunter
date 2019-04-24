<!doctype html>
<html>
    <head>
        <title>ClickJacking Tool</title>
        <style>
            #data{display:none;}
        </style>

        <script>
            function clickjacking() {
                var url = document.getElementById("url").value;
                url= url.trim();
                document.getElementById("data").style.display = "none";
                if(url.length > 3){
                    document.getElementById("data").style.display = "block";
                    document.getElementById("data").setAttribute("src", url);
                }
            }
        </script>

    </head>

    <body>
        <center style="margin-top:30px;">
            <h2 style="font-family:arial;color:#666666;">ClickJacking Vulnerability</h2>
            <input type="text" id="url" style="width:250px;padding:5px;border-radius:5px;border:1px solid #b3b3b3;">
            <button type="button" onclick="clickjacking()" style="padding:5px 15px;cursor:pointer;border-radius:6px;border:none;background:#00b386;color:white;font-size:16px;">Exploit</button><br/><br/><br/>
            <iframe id="data" style="width:600px;height:400px;" frameborder="2px"></iframe>
        </center>


    </body>
</html>
