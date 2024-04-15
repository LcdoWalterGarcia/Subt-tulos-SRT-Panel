<!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Subtitles SRT Manager</title>
        <meta name="googlebot" content="noindex">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="assets/js/input-file.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/custom.css">
      </head>
      <body>
              <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                  <div class="navbar-header">
                  </div>
                </div>
              </nav>

              <div class="container">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>Subtitles SRT Manager</h1>
                        </div>

                        <div class="panel-body">
                            <form role="form" method="post" enctype="multipart/form-data" onsubmit="return doUpload();">
                               <p>             
                                  <div class="input-group">
                                    <label class="input-group-btn">
                                        <span class="btn btn-success">
                                            Choose File... <input type="file" name="file" id="file" style="display: none;" multiple/>
                                        </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                  </div>
                               </p>
                               <p><input type="submit" class="btn btn-primary" value="Upload" /></p>
                            </form>

                            <div id="progress-group" class="progress progress-striped active">
                                <div class="progress">
                                  <div class="progress-bar" style="width: 0%;"></div>
                                  <div class="progress-text"></div>
                                </div>
                            </div>

                            <div id="result"></div>
                        </div>
                    </div><!-- /.panel-primary -->


                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h1>List Subtitles</h1>
                        </div>

                        <div class="panel-body">
                         <table class="table table-bordered table-striped" id="subtitles">
                            <thead>
                              <tr>
                                <th>Time</th>
                                <th>File Name</th>
                                <th>File Input</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php 
								
								$domainServer = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']);
								
                                $dir = 'files';

                                $file = scandir($dir, 1);

                                foreach ($file as $key => $value) 
                                { 
                                    preg_match('/([0-9]*)\..*/', $value, $match);

                                    if (!in_array($value, array(".", ".."))) 
                                    { 
                                       echo '<tr>
                                              <td>'.date("M d, Y - h:i:sa", $match[1]).'</td>
                                              <td>'.$domainServer.'/files/' . $value . '</td>
                                              <td>
                                                <input type="text" class="form-control" value="'.$domainServer.'/files/' . $value . '" style="width: 100%;" onclick="this.select();"/>
                                              </td>
                                            </tr>';
                                    }
                                } 

                              ?>

                            </tbody>
                          </table>

                          <script type="text/javascript">
                            $(document).ready(function(){
                                $('#subtitles').DataTable({
                                  "order": [[ 1, "desc" ]]
                                });
                            });
                          </script>
                        </div>
                    </div><!-- /.panel-primary -->


              </div><!-- /.container -->
          
        <script type="text/javascript" src="assets/js/function.js"></script>
      </body>
      </html>