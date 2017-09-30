app.controller("myctrl",($scope, $window ,myfactory)=>{
   
    $scope.submitform = ()=>{
    
        var obj = {};
        
         
        obj.username= "c" + $scope.mobilenumber;
        obj.password=$scope.password;
        var mobilenumber= $scope.mobilenumber;
        localStorage.setItem('mobilenumber',mobilenumber);
        
        console.log(obj)
       
          var promise = myfactory.callserver(obj);
          promise.then((data)=>{
                 
                console.log(data);

                if (data.key) {
                    
                   
//                    $window.location.href = "https://www.halanx.com/halanx-final/new1big-kfc/frontpage/index1.html";
                    $window.location.href = "../../new1big-kfc/frontpage/index1.html";

                }
            },(err)=>{
                
                alert("error");
            })
       
    }
})