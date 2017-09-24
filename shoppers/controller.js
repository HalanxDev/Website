 app.controller("myctrl",($scope,myfactory)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        obj.FirstName = $scope.firstname;
        obj.LastName = $scope.lastname;
        obj.PhoneNo = $scope.mobilenumber;
        obj.EmailId = $scope.email;
        obj.password=$scope.password;
        obj.City = $scope.city;
         
        console.log(obj)
       
          var promise = myfactory.callserver(obj);
          promise.then((data)=>{
				 
				console.log(data);
			},(err)=>{
				
				alert("error");
			})
       
    }
})