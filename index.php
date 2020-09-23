<!DOCTYPE html>
<html>
      <head>
           <title>php crud
           </title>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
           <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      </head>
      <body>
          <?php require_once 'process.php';?>

          <?php
           if (isset($_SESSION['message'])): ?>
           <div class = "alert alert-<?=$_SESSION['msg_type']?>">
               <?php 
                  echo $_SESSION['message'];
                  unset($_SESSION['message']);
                ?>
            </div>
            <?php endif ?>
          <div class = "container">
          <?php
              $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
              $result = $mysqli->query("SELECT * FROM `user details` ") or die($mysqli->error);
              //pre_r($result);
              //pre_r($result->fetch_assoc());
              //pre_r($result->fetch_assoc());
            ?>

            <div class = "row justify-content-center">
               <table class = "table">
                    <thead>
                         <tr>
                             <th>Name</th>
                             <th>Location</th>
                             <th>Email</th>
                             <th colspan = "2">Action</th>
                         </tr>
                    </thead>
                    <?php 
                       while ($row = $result->fetch_assoc()): ?>
                       <tr>
                           <td><?php echo $row['Name'];?></td>
                           <td><?php echo $row['Location'];?></td>
                           <td><?php echo $row['Email'];?></td>
                           <td>
                              <a href = "index.php?edit=<?php echo $row['ID']; ?>"
                                class = "btn btn-info">Edit</a>
                               <a href = "process.php?delete=<?php echo $row['ID']; ?>"
                                 class = "btn btn-danger">Delete</a>
                           
                           </td>
                       </tr>
                       <?php endwhile; ?>
               </table>

            </div>

           <?php
              function pre_r($array){
                  echo '<pre>';
                  print_r($array);
                  echo '</pre>';
              }

           ?>

          <div class = "row justify-content-center">
            <form action="process.php" method = "POST">
                  <input type = "hidden" name = "ID" value = "<?php echo $ID; ?>" >
                  <div class = "form-group">
                     <label>Name</label>
                     <input type = "text" name = "name" class = "form-control" value = "<?php echo $name; ?>" placeholder = "Enter your name">
                  </div>
                  <div class = "form-group">
                      <label>Location</label>
                      <input type = "text" name = "location" class = "form-control" value ="<?php echo $location; ?>" placeholder = "Enter your location">
                  </div>
                  <div class = "form-group">
                       <label>Email</label>
                        <input type = "email" name = "email" class = "form-control" value = "<?php echo $email; ?>" placeholder = "Enter your email">
                  </div>
                  <div class = "form-group">
                     <?php if ($update == true):
                     ?>
                      <button type = "submit" class = "btn btn-info" name = "update"> Update</button>
                     <?php else: ?>
                      <button type = "submit" class = "btn btn-primary" name = "save"> Save</button>
                     <?php endif; ?>
                  </div>
            </form>
           </div>
          </div>
      </body>
</html>
