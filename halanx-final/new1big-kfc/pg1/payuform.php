<?php

$MERCHANT_KEY = "f1tDUh";  
   $hash_string = '';
 
$SALT = "jfrDJ9yt"; 

 
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
     
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
    
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
 
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
         
  ) {
    $formError = 1;
  } else {
    
	$hashVarsSeq = explode('|', $hashSequence);
 
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<!DOCTYPE html>
  <head>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="icon" type="image/png" sizes="16x16" href="logo.png">
     <link rel="stylesheet" href="payment.css">
     <script src="../account/aangular.min.js"></script>
     <script src="../account/module.js"></script>
     <script src="../account/factory.js"></script>
     <script src="../account/controller.js"></script>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
<style>

.bg1{
  margin-top:100px;
}
</style>
  </head>









  <body onload="submitPayuForm()" data-spy="scroll" data-target="#myScrollspy" ng-app="myapp" ng-controller="myctrl">

  <nav class="navbar navbar-fixed-top" role="navigation">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                  
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="../../index.html"><img src="https://s3-us-west-2.amazonaws.com/halanx-web/logo.png" class="img-responsive img-circle" width="50" height="50"> </a>
              <a class="navbar-brand navbar-bg" href="../../index.html">Halanx</a>
          </div>
         
           
      </div>
  </nav>
     
    
    <div class="container-fluid bg1" name="toTop" id="toPos">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
    <form action="<?php echo $action; ?>" method="post" name="payuForm" >
    <fieldset>
    
                    <legend>Payment Details</legend>

      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
	    <input type="hidden" name="surl" value="https://www.halanx.com/halanx-final/new1big-kfc/pg1/response.php" />   <!--Please change this parameter value with your success page absolute url like http://mywebsite.com/response.php. -->
		  <input type="hidden" name="furl" value="https://www.halanx.com/halanx-final/new1big-kfc/pg1/response.php" /><!--Please change this parameter value with your failure page absolute url like http://mywebsite.com/response.php. -->
	  
	
	  
	      <div class="form-group">
	       <div class="row">
         <div class="col-md-12">
          <label for="amount">Amount</label>
          <input name="amount" id="amount" value="localStorage.getItem('amount')" class="form-control" readonly/>
          </div>
          </div>
          </div>

          <div class="form-group">
         <div class="row">
         <div class="col-md-12">
          <label for="firstname">First Name</label>
          <input type="hidden" name="firstname" id="firstname" class="form-control" value="null"/>
           </div>
          </div>
          </div>
        
         <div class="form-group">
         <div class="row">
         <div class="col-md-12">
          <label for="email">Email</label>
          <input type="hidden" name="email" id="email" class="form-control" value="null" />
          </div>
          </div>
 
         <div class="form-group">
         <div class="row">
         <div class="col-md-12">
          <label for="phone">Mobile Number</label>
           <input type="hidden" id="mobilenumber" class="form-control" name="phone"  value="localStorage.getItem('mobilenumber')"  readonly/> 
         </div>
          </div>
          </div>
          <div class="form-group">
         <div class="row">
         <div class="col-md-12">
        <label for="productinfo">Product Info</label>
           <input type="hidden" class="form-control" name="productinfo" value="null">
         </div>
          </div>
          </div>
        

        
 
         
          <?php if(!$hash) { ?>
            <input type="submit" class="btn btn-md btn-danger" value="Continue" /> 
          <?php } ?>
        
    </form>
    </div>
    </div>
    </div>
	    </div>
    <div class="container-fluid bg3">
 <div class="row row_11">
   <div class="col-md-2   text-center"><a href="../../aboutus.html">About Us</a></div>
   <div class="col-md-2  text-center"><a href="#">Careers</a></div>
   <div class="col-md-2  text-center"><a href="#">Blog</a></div>
   <div class="col-md-2  text-center"><a href="../../privacy.html">Privacy</a></div>
   <div class="col-md-2  text-center"><a href="../../contactus.html">Contact Us</a></div>
   <div class="col-md-2 text-center"><a href="../../terms.html">Terms</a></div>
 </div>

 <div class="row row_13">
   <div class="text-center center-block">
        <a href="https://www.facebook.com/halanxtech"><i id="social-fb" class="fa fa-facebook-square fa-2x social"></i></a>
      <a href="https://www.twitter.com/halanxtech"><i id="social-tw" class="fa fa-twitter-square fa-2x social"></i></a>
      <a href="https://www.instagram.com/halanxtech"><i id="social-gp" class="fa fa-instagram fa-2x social"></i></a>
      <a href="https://in.linkedin.com/company/halanx"><i id="social-tw" class="fa fa-linkedin-square fa-2x social"></i></a>
    
   </div>
 </div>

 <div class="row row_12">
   <span class="glyphicon glyphicon-copyright-mark"> Halanx 2017 </span>
 </div>
</div>

   
    
</body>
<script>
$(function(){
var navbar = $('.navbar');
$(window).scroll(function(){
    if($(window).scrollTop() <= 40){
      navbar.css('box-shadow', 'none');
    } else {
      navbar.css('box-shadow', '0px 10px 20px rgba(0, 0, 0, 0.4)'); 
    }
});  
})
$(function(){
var stickyElement   = '.panel-affix',    
bottomElement   = '#fake-footer';  
if($( stickyElement ).length){
$( stickyElement ).each(function(){
   
  var fromTop = $( this ).offset().top, 
    
    fromBottom = $( document ).height()-($( this ).offset().top + $( this ).outerHeight()),
    
    stopOn = $( document ).height()-( $( bottomElement ).offset().top)+($( this ).outerHeight() - $( this ).height()); 
   
  if( (fromBottom-stopOn) > 200 ){
     
    $( this ).css('width', $( this ).width()).css('top', 0).css('position', '');
     
    $( this ).affix({
      offset: { 
        
        top: fromTop - 80,  
         
        bottom: stopOn
      }
    
    }).on('affix.bs.affix', function(){ $( this ).css('top', '80px').css('position', ''); });
  }
  
  $( window ).trigger('scroll'); 
}); 
}
});
$('body').scrollspy({
offset: 80
});
$(function() {
$('a[href*=#]:not([href=#])').click(function() {
if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
var target = $(this.hash);
target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
if (target.length) {
$('html,body').animate({
  scrollTop: target.offset().top
}, 1000);
return false;
}
}
});
});
</script>
  </body>
  <script>
   
    var mobilenumber= localStorage.getItem('mobilenumber');
    document.getElementById('mobilenumber').value=mobilenumber;
    var amount=localStorage.getItem('amount');
    document.getElementById('amount').value=amount;
  

  </script>
</html>
