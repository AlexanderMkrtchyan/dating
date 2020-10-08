<?php
function ibenic_file_upload()
{

    $usingUploader = 3;

    $fileErrors = array(
        0 => "There is no error, the file uploaded with success",
        1 => "The uploaded file exceeds the upload_max_files in server settings",
        2 => "The uploaded file exceeds the MAX_FILE_SIZE from html form",
        3 => "The uploaded file uploaded only partially",
        4 => "No file was uploaded",
        6 => "Missing a temporary folder",
        7 => "Failed to write file to disk",
        8 => "A PHP extension stoped file to upload"
    );

    $posted_data =  isset($_POST) ? $_POST : array();
    $file_data = isset($_FILES) ? $_FILES : array();

    $data = array_merge($posted_data, $file_data);

    $response = array();

    if ($usingUploader == 1) {
        $uploaded_file = wp_handle_upload($data['ibenic_file_upload'], array('test_form' => false));
return 'fuck';
        if ($uploaded_file && !isset($uploaded_file['error'])) {
            $response['response'] = "SUCCESS";
            $response['filename'] = basename($uploaded_file['url']);
            $response['url'] = $uploaded_file['url'];
            $response['type'] = $uploaded_file['type'];
        } else {
            $response['response'] = "ERROR";
            $response['error'] = $uploaded_file['error'];
        }
    } elseif ($usingUploader == 2) {
        $attachment_id = media_handle_upload('ibenic_file_upload', 0);

        if (is_wp_error($attachment_id)) {
            $response['response'] = "ERROR";
            $response['error'] = $fileErrors[$data['ibenic_file_upload']['error']];
        } else {
            $fullsize_path = get_attached_file($attachment_id);
            $pathinfo = pathinfo($fullsize_path);
            $url = wp_get_attachment_url($attachment_id);
            $response['response'] = "SUCCESS";
            $response['filename'] = $pathinfo['filename'];
            $response['url'] = $url;
            $type = $pathinfo['extension'];
            if (
                $type == "jpeg"
                || $type == "jpg"
                || $type == "png"
                || $type == "gif"
            ) {
                $type = "image/" . $type;
            }
            $response['type'] = $type;
        }
    } else {
        $upload_dir = wp_upload_dir();
        $upload_path = $upload_dir["basedir"] . "/custom/";
        $upload_url = $upload_dir["baseurl"] . "/custom/";

        if (!file_exists($upload_path)) {
            mkdir($upload_path);
        }
        $fileName = $data["ibenic_file_upload"]["name"];
        $fileNameChanged = str_replace(" ", "_", $fileName);

        $temp_name = $data["ibenic_file_upload"]["tmp_name"];
        $file_size = $data["ibenic_file_upload"]["size"];
        $fileError = $data["ibenic_file_upload"]["error"];
        $mb = 2 * 1024 * 1024;
        $targetPath = $upload_path;
        $response["filename"] = $fileName;
        $response["file_size"] = $file_size;

        if ($fileError > 0) {
            $response["response"] = "ERROR";
            $response["error"] = $fileErrors[$fileError];
        } else {
            if (file_exists($targetPath . "/" . $fileNameChanged)) {

                $response["response"] = "ERROR";
                $response["error"] = "File already exists.";
            } else {

                if ($file_size <= $mb) {

                    if (move_uploaded_file($temp_name, $targetPath . "/" . $fileNameChanged)) {

                        $response["response"] = "SUCCESS";
                        $response["url"] =  $upload_url . "/" . $fileNameChanged;
                        $file = pathinfo($targetPath . "/" . $fileNameChanged);

                        if ($file && isset($file["extension"])) {
                            $type = $file["extension"];
                            if (
                                $type == "jpeg"
                                || $type == "jpg"
                                || $type == "png"
                                || $type == "gif"
                            ) {
                                $type = "image/" . $type;
                            }
                            $response["type"] = $type;
                        }
                    } else {
                        $response["response"] = "ERROR";
                        $response["error"] = "Upload Failed.";
                    }
                } else {
                    $response["response"] = "ERROR";
                    $response["error"] = "File is too large. Max file size is 2 MB.";
                }
            }
        }
    }

    echo json_encode($response);
    die();
}
