<?php 

  $mimes = array(
    'application/octet-stream'
  );
  sleep(1);
  if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $replaceFilename = array(' ', '_.', '._', '-', '..');
    $fileName = str_replace($replaceFilename, '.', $fileName);

    $fileType = $_FILES['file']['type'];
    $fileError = $_FILES['file']['error'];
    $fileStatus = array(
      'status' => 0,
      'message' => '',
      'result' => ''
    );
    if ($_FILES['file']['size'] < 2048000) {
      if (!in_array($fileType, $mimes)) {
        $fileStatus['message'] = 'Only Sub file .srt are allowed!';
      } 
      else {
		$domainServer = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
		
        move_uploaded_file($_FILES["file"]["tmp_name"], 'files/' . time() . '.' . $fileName);

        $imagePath = $domainServer . '/files/' . time() . '.' . $fileName;

        $fileStatus['status'] = 1;

        $fileStatus['message'] = '<i class="fa fa-check-circle-o"></i> Process completed....';

        $fileStatus['result'] = '<input type="text" class="form-control" value="'.$imagePath.'" onclick="this.select();"/>';
      }

    } 
    else{
        $fileStatus['status'] = 0;

        $fileStatus['message'] = '<i class="fa fa-exclamation-triangle"></i> The maximum file size for uploads is 2MB.';

        $fileStatus['result'] = '';
    }
    
    echo json_encode($fileStatus);

    exit();
  }

?>