<?php
session_start();
require_once 'class.user.php';



$user_login = new USER();

 
 if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		$user_login->redirect('../admin/#Profile');
	}
}
?> 

<!DOCTYPE html>
<html>
  <head>
    <title>Login </title>
	  <link rel="shortcut icon" type="image/x-icon" href="http://128.199.207.109/admin/assets/img/favicons/fab1.png">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
				<link href="../my/css.css" rel="stylesheet" type="text/css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

<style>	
 
#container{
 
  font-family: "Archivo Black";
}
#original{
  font-size: 5em;
  letter-spacing:.3em;
  color: #fff;
  transform: skewX(6deg);
}
#original::after{
  content:"FUTURE";
  position: absolute;
  top: 9px;
  left: 26px;
  color: #bbb;
  z-index: -1;
  transform: rotateX(-46deg) skewX(-38deg);
}
</style>	
	
	
	</head>

 
  <body id="login"class="bg5 " style="background: #007b ff;">
<!--
<div class="bounce hidden-xs">
<span class="letter">R </span>
<span class="letter">
<img src='logo.png' style="height: 150px" class="img">
</span><span class="letter"> A</span>
<span class="letter">H</span>
<span class="letter">M</span>
<span class="letter">A</span>
<span class="letter">N</span>

</div> -->
 
		<div class="container">
		<div class="signup-form-container">
 
<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Wrong Details!</strong> 
			</div>
            <?php
		}
		?>
			<form class="" method="post" >
				<div class="form-header">
					<h3 class="form-title"><i class="fa fa-user"></i><span class="glyphicon glyphicon-user"></span> Sign In</h3>
					
					<div class="pull-right">
						<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span></h3>
						</div> 
					
				</div>
				
				<div class="form-body" >
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
							<input   id="email" type="text" class="form-control" autocomplete="on"  maxlength="50"placeholder="Email address"name="txtemail"autofocus="true"  required >
						</div> 
						<span class="help-block" id="error"></span>                     
					</div>					
									
 					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
							<input  type="password" id="name" class="form-control" placeholder="Password" name="txtupass" required">
						</div>
						<span class="help-block" id="error"></span>
					</div>
								
					</div>				
				
				<div class="form-footer"  >
					<button type="submit"  class="btn btn-danger" id="btn-signup"name="btn-login"><span class="glyphicon glyphicon-log-in"></span> Sign In</button>
 				
				<a href="fpass" style="float:right" class="text-danger">Forgot password? </a>	
				</div>
 
				
			</form>
			
			
			
			
			
		</div> 
	</div> <!-- /container -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
    <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ricostacruz.com/jquery.transit/jquery.transit.min.js'></script>

    <script>

   
   
   
var background = {}
  
  background.initializr = function (){
    
    var $this = this;
     

   
    //option
    $this.id = "background_css3";
    $this.style = {bubbles_color:"#fff",stroke_width:0, stroke_color :"black"};
    $this.bubbles_number = 30;
    $this.speed = [1500,8000]; //milliseconds
    $this.max_bubbles_height = $this.height;
    $this.shape = false // 1 : circle | 2 : triangle | 3 : rect | false :random
    
    if($("#"+$this.id).lenght > 0){
      $("#"+$this.id).remove();
    }
    $this.object = $("<div style='z-inde:-1;margin:0;padding:0; overflow:hidden;position:absolute;bottom:0' id='"+$this.id+"'> </div>'").appendTo("body");
    
    $this.ww = $(window).width()
    $this.wh = $(window).height()
    $this.width = $this.object.width($this.ww);
    $this.height = $this.object.height($this.wh);
    
    
    $("body").prepend("<style>.shape_background {transform-origin:center; width:80px; height:80px; background: "+$this.style.bubbles_color+"; position: absolute}</style>");
    
    
    for (i = 0; i < $this.bubbles_number; i++) {
        $this.generate_bubbles()
    }
    
  }

  
  
  

   background.generate_bubbles = function() {
     var $this = this;
     var base = $("<div class='shape_background'></div>");
     var shape_type = $this.shape ? $this.shape : Math.floor($this.rn(1,3));
     if(shape_type == 1) {
       var bolla = base.css({borderRadius: "50%"})
     }else if (shape_type == 2){
       var bolla = base.css({width:0, height:0, "border-style":"solid","border-width":"0 40px 69.3px 40px","border-color":"transparent transparent "+$this.style.bubbles_color+" transparent", background:"transparent"}); 
     }else{
       var bolla = base; 
     }    
     var rn_size = $this.rn(.8,1.2);
     bolla.css({"transform":"scale("+rn_size+") rotate("+$this.rn(-360,360)+"deg)", top:$this.wh+100, left:$this.rn(-60, $this.ww+60)});        
     bolla.appendTo($this.object);
     bolla.transit({top: $this.rn($this.wh/2,$this.wh/2-60), "transform":"scale("+rn_size+") rotate("+$this.rn(-360,360)+"deg)", opacity: 0},$this.rn($this.speed[0],$this.speed[1]), function(){
       $(this).remove();
       $this.generate_bubbles();
     })
       
    }


background.rn = function(from, to, arr) {
  if(arr){
          return Math.random() * (to - from + 1) + from;
  }else{
    return Math.floor(Math.random() * (to - from + 1) + from);
  }
    }
//background.initializr()
window.close();
</script>


  </body>
</html>