app.controller("productctrl",function($scope,myfactory){
    console.log("hello")
     var key = localStorage.getItem("mykey");
         var usekey=JSON.parse(key);
          console.log(usekey)
          promise = myfactory.productserver(usekey);
    promise.then(function(data){
        console.log(data)
//       $scope.productdata = data
        console.log(data)
      
    },
                 function(err){
        alert("err")
        
    }
                );
})
    