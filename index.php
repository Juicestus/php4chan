<html>
    <head>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="header">
            <h1>PHP 4chan clone</h1>
        </div>
        <div id="postBox">
            <form action="shout.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Name:</td>
                        <td>
                            <input type="text" name="name" value="Anonymous">
                            <input type="submit" value="Post">
                        </td>
                    </tr>
                    <tr>
                        <td>Post:</td>
                        <td>
                            <textarea name="post"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Upload:</td>
                        <td>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
            echo file_get_contents("posts.html");
        ?>
    </body>
</html>
