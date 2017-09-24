app.controller("myctrl",($scope,myfactory)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        obj.Dealer_FirstName = $scope.firstname;
        obj.Dealer_LastName = $scope.lastname;
        obj.StoreName = $scope.storename;
        obj.StoreAddress = $scope.storeaddress;
        obj.Dealer_EmailId=$scope.email
        obj.Dealer_password = $scope.password;
         
        console.log(obj)
       
          var promise = myfactory.callserver(obj);
          promise.then((data)=>{
				 
				console.log(data);
			},(err)=>{
				
				alert("error");
			})
       
    }
})