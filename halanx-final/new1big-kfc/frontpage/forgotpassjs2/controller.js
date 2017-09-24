app.controller("myctrl",($scope,myfactory)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        
        obj.new_password1=$scope.newpass;
        obj.new_password2= $scope.cpass;
        
         
        console.log(obj)
       
          var promise = myfactory.callserver(obj);
          promise.then((data)=>
          {
          console.log(data);
          if(data.key){
              alert("Password Reset!");
          }
          },(err)=>{
          alert("error");
          })
       
    }
})