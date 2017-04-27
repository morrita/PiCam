function changePhotoHandler()
{
        // only handle requests in "loaded" state
        if (xhr.readyState == 4)
        {
                // hide progress
                document.getElementById("loader").style.display = "none";

                if (xhr.status == 200) {

                    var str1 = "<img id=\"pic\"  src=\""; 
                    var str2 = xhr.responseText; 
                    var str3 = "\"  alt=\"PiCam picture\" >";
                    var html_str = str1 + str2 + str3;

                    document.getElementById("content").innerHTML = html_str;
                    deletePhoto ("/var/www/html" + str2);

                }
                else {

                    alert("Error with Ajax call!");

                }
        }
}


function deletePhoto(filename)
{
            // instantiate XMLHttpRequest object
            try
            {
                pd = new XMLHttpRequest();
            }
            catch (e)
            {
                pd = new ActiveXObject("Microsoft.XMLHTTP");
            }

            // handle old browsers
            if (pd == null)
            {
                alert("Ajax not supported by your browser!");
                return;
            }

            url = "delete_photo.php?file=" + filename;

            pd.open("GET", url, true);
            pd.send(null);
}


function getPhotoRequest(width,height)
{
  
            // instantiate XMLHttpRequest object
            try
            {
                xhr = new XMLHttpRequest();
            }
            catch (e)
            {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            // handle old browsers
            if (xhr == null)
            {
                alert("Ajax not supported by your browser!");
                return;
            }

            document.getElementById("loader").style.display = "block";
            document.getElementById("content").innerHTML = "Loading...";

            url = "take_photo.php" + "?width=" + width + "&height=" + height;

            xhr.onreadystatechange = changePhotoHandler;
            xhr.open("GET", url, true);
            xhr.send(null);
}
