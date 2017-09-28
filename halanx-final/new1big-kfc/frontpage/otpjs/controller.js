app.controller("myctrl",($scope,myfactory,$window)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        var firstname= localStorage.getItem('FirstName');
        obj.FirstName =firstname;
        var lastname=localStorage.getItem('LastName');
        obj.LastName=lastname;
        var phoneno= localStorage.getItem('PhoneNo');
        obj.PhoneNo= phoneno;
        var email=localStorage.getItem('email');
        obj.email=email;
        var password=localStorage.getItem('password');
        obj.password=password;
        obj.otp= parseInt($scope.otp);
        obj.username= "c" + phoneno;
        
         
        console.log(obj)
       
          var promise = myfactory.callserver(obj);
          promise.then((data)=>{
                 
                console.log(data);
                 
                   // $window.location.href = "https://www.halanx.com/halanx-final/new1big-kfc/frontpage/login.html";
                 
            },(err)=>{
                
                alert("error");
            })
       
    }
})