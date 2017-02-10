<?php  

    class myFunc{

        // my mysqli sql query result function || uses prepared statement
        function myResult($query, $datatype, $variables){
            include("db.php");
            $stmt = $conn->prepare($query);
            $param = array();
            $count = count($variables);
            for($i = 0; $i < $count; ++$i){
                $param[] = &$variables[$i];
            }
            array_unshift($param, $datatype);
            call_user_func_array(array($stmt, 'bind_param'), $param);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conn->close();

            return $result;
        }

        // my mysqli api fetch function || uses prepared statement
        function myFetch($query, $datatype, $variables){
            include("db.php");
            $stmt = $conn->prepare($query);
            $param = array();
            $count = count($variables);
            for($i = 0; $i < $count; ++$i){
                $param[] = &$variables[$i];
            }
            array_unshift($param, $datatype);
            call_user_func_array(array($stmt, 'bind_param'), $param);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            $conn->close();

            return $result->fetch_assoc();
        }

        // my email function
        function sendmail($to,$from,$subject,$message){
        
            // headers
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
              
            //send email
            mail($to, "$subject", $message, $headers);
        }

        // my salt function.
        function cryptPass($input, $rounds = 9){
            $salt = "";

            $saltChars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));

            for($i = 0; $i < 22; $i++){
                $salt .= $saltChars[array_rand($saltChars)];
            }

            return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
        }

        function imgUpload($path,$imgName,$imgTemp,$imgSize){ 
            $target_dir = $path;
            $target_file = $target_dir . basename($imgName);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
                $check = getimagesize($imgTemp);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo '
                            <p class="text-center"> File is not an image</p>';
                    $uploadOk = 0;
                    return false;
                }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo '<p class="text-center"> Oops, this image already exist yeah.</p>';
                $uploadOk = 0;
                return false;
            }
            // Check file size
            if ($imgSize > 1000000) {
                echo '
                            <p class="text-center"> Image too big, please compress</p>';
                $uploadOk = 0;
                return false;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo '
                            <p class="text-center">Only image of type jpg, jpeg, gif and png are accepted</p>';
                $uploadOk = 0;
                return false;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo '
                            <p class="text-center"> Sorry but your image was not uploaded</p>';
            // if everything is ok, try to upload file
                return false;
            } else {
                if (move_uploaded_file($imgTemp, $target_file)) {
                    return true;
                } else {
                    echo '
                            <p class="text-center"> We encounterd an error whiles processing your image</p>';
                    return false;
                }
            }
        }
    }
?>