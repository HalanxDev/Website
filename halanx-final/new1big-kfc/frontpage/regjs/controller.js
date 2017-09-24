app.controller("myctrl",($scope,myfactory)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        
        obj.FirstName = $scope.firstname;
        obj.LastName=$scope.lastname;
        obj.email =$scope.email;
        obj.password=$scope.password;
        obj.PhoneNo=$scope.mobilenumber;
        obj.otp=$scope.otp;
        obj.username= "c" + $scope.mobilenumber;
        
         
        console.log(obj)
       
          var promise = myfactory.callserver(obj);
          promise.then((data)=>
          {
          console.log(data);
          if(data.key){
              alert("Successfully Registered!");
          }
          },(err)=>{
          alert("error");
          })
       
    }
})