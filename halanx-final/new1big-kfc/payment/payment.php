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
<head>
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

</head>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Halanx</title>
 <meta content="width=device-width, initial-scale=1.0" name="viewport" >
 <link rel="icon" type="image/png" sizes="16x16" href="logo.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<link rel="stylesheet" href="style.css">
<script src="../libs/angular.min.js"></script>

<script>
var app = angular.module("myapp",[]);
    app.controller("myctrl",($scope,myfactory)=>{
       $scope.postorder = ()=>{
           
           var obj = {};
           obj.DeliveryDate = localStorage.getItem("DeliveryDate");
           var json =  localStorage.getItem("Address");
           var splitaddress = JSON.parse(json)
           obj.DeliveryAddress =splitaddress.Flatno+ ","+splitaddress.Area +","+splitaddress.city
             obj.AsSoonAsPossible =  localStorage.getItem("AsSoonAsPossible");
            obj.StartTime = localStorage.getItem("StartTime");
//                    localStorage.getItem("StartTime");
           var destination = localStorage.getItem("obj");
           var latlon = JSON.parse(destination)
           obj.Latitude = latlon.Latitude;
           obj.Longitude = latlon.Longitude;
           console.log(obj)
           var token = myfactory.gettoken();
          var promise =  myfactory.placeorder(obj,token);
           promise.then(function(data){
    console.log(data)
//       $scope.storedata = data;
//        console.log($scope.storedata);
    
    
  },function(err){
     
} );
       } 
    })
    app.factory("myfactory",($http,$q)=>{
       var object = {
          placeorder : function(obj,key){
               var pr = $q.defer();
     var url = "https://api.halanx.com/orders/";
    
       console.log(obj)     
     $http.post(url,obj,{
//             withCredentials: true,
            headers: {
                'Authorization': 'Token ' +key 
            }
     }).then(function(data){
         pr.resolve(data.data)
         console.log("success")
       
     },
                         function(err){
         pr.reject(err)
         console.log("error")
         
     }
     )
     return pr.promise
          },
            gettoken : function(){
     var token = localStorage.getItem("token")
       
      var mytoken=JSON.parse(token)
      return mytoken; 
    }
       } 
       return object
    })
</script>
</head>
<body onload="submitPayuForm()" data-spy="scroll" data-target="#myScrollspy" ng-app="myapp" ng-controller="myctrl">










<form action="<?php echo $action; ?>" method="post" name="payuForm" >
 
  <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
  <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
  <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
  <input type="hidden" name="surl" value="https://www.halanx.com/halanx-final/new1big-kfc/pg1/response.php" />    
  <input type="hidden" name="furl" value="https://www.halanx.com/halanx-final/new1big-kfc/pg1/response.php" />



   

<input name="amount" id="amount" value="localStorage.getItem('amount')" class="form-control"  />

<input type="hidden" name="firstname" id="firstname" class="form-control" value="null"/>


<input type="hidden" name="email" id="email" class="form-control" value="null" />


<input type="hidden" id="mobilenumber" class="form-control" name="phone"  value="localStorage.getItem('mobilenumber')"  /> 

<input type="hidden" class="form-control" name="productinfo" value="null">


    

     
      
    




 

 
<script>

var mobilenumber= localStorage.getItem('mobilenumber');
document.getElementById('mobilenumber').value=mobilenumber;
var amount=localStorage.getItem('amount');
document.getElementById('amount').value=amount;


</script>



 
<nav class="navbar navbar-fixed-top" role="navigation">
  <div class="container-fluid">
      <!-- add header -->
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../../../index.html"><img src="https://s3-us-west-2.amazonaws.com/halanx-web/logo.png" class="img-responsive img-circle" width="50" height="50"> </a>
          <a class="navbar-brand navbar-bg" href="../../../index.html">Halanx</a>
      </div>
       
       
  </div>
</nav>


<div id="content">
  <div class="container-fluid bg1" name="toTop" id="toPos">
      <div class="row">
           <div class="col-md-4 col-md-offset-4 col-sm-6">
             <div class="payment">
             <ul>
             <li>
             <input type="submit" value="Cash on Delivery" class="btn btn-lg btn-default" ng-click="postorder()"/>
              </li>
              
             

               <li>
                  <?php if(!$hash) { ?>
                   <input type="submit"  value="Credit/Debit Card" class="btn btn-lg btn-default" ng-click="postorder()"/>  
                  <?php } ?>
                  </li>
              </div>
          </div>
      </div>
  </div>
</div>
</div>


      <div class="container-fluid bg3">
 <div class="row row_11">
   <div class="col-md-2   text-center"><a href="../../aboutus.html">About Us</a></div>
   <div class="col-md-2  text-center"><a href="#">Careers</a></div>
   <div class="col-md-2  text-center"><a href="#">Blog</a></div>
   <div class="col-md-2  text-center"><a href="../../contactus.html">Contact Us</a></div>
   <div class="col-md-2  text-center"><a href="../../privacy.html">Privacy</a></div>
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
      navbar.css('box-shadow', '0px 4px 20px rgba(0, 0, 0, 0.3)'); 
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
</html>