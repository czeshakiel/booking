<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>KOILEE PICKLEBALL BOOKING SYSTEM</title>    
    <link rel="stylesheet" href="<?=base_url('design/users/style.css');?>">
   <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
   <link rel="shortcut icon" href="<?=base_url('design/users/koileelogo.jpg');?>">
  </head>
  <body>
    <div class="bg-img">
      <div class="content">
        <header>Admin Portal</header>
        <form action="<?=base_url('admin_authenticate');?>" method="POST">
          <div class="field">
            <span class="fa fa-user"></span>
            <input type="text" required placeholder="Username" name="username" autocomplete="off">
          </div>
          <div class="field space">
            <span class="fa fa-lock"></span>
            <input type="password" class="pass-key" required placeholder="Password" name="password" id="pwd" autocomplete="off">            
          </div>
          <div class="pass">
            <div class="signup">
              <input type="checkbox" onclick="pwd.type =  checked ? 'text' : 'password'"> Show Password
            </div>
            <?php
            if($this->session->flashdata('error')){
                echo "<div style='color:red;'>".$this->session->error."</div>";
            }
            if($this->session->flashdata('success')){
                echo "<div style='color:green;'>".$this->session->success."</div>";
            }
            ?>
          </div>                
          <div class="field space">
            <input type="submit" value="LOGIN">
          </div>
        </form>       
      </div>
    </div>
  </body>
</html>
