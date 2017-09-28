app.controller("myctrl",($scope,myfactory,$window)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        console.log(localStorage.FirstName);
        obj.FirstName = $scope.firstname;
        obj.PhoneNo=$scope.mobilenumber;
        
        var FirstName= $scope.firstname;
        localStorage.setItem('FirstName',FirstName);
        var LastName= $scope.lastname;
        localStorage.setItem('LastName',LastName);
        var PhoneNo= $scope.mobilenumber;
        localStorage.setItem('PhoneNo',PhoneNo);
        var email=$scope.email;
        localStorage.setItem('email',email);
        var password=$scope.password;
        localStorage.setItem('password',password);


         
        console.log(obj)
        
          var promise = myfactory.callserver(obj);
          promise.then((data)=>
          {
          console.log(data);
          $window.location.href="http://localhost/test2/halanx-final/new1big-kfc/frontpage/registerotp.html";
       
                   

                 
        
           
          },(err)=>{
          alert("error");
          })
       
    }
})