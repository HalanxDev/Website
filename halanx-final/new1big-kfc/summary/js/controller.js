 app.controller("myctrl",($scope,myfactory)=>{
     if(localStorage.token){
    ordersummary();
     }
    function ordersummary(){
//        var mobilenumber = localStorage.getItem("mobilenumber");
                  
                    var token = myfactory.gettoken();
                    var promise = myfactory.bill(token)
                          promise.then(function(data){
                    console.log(data);
                              $scope.cost = data;
                             // var amount= data.TotalWithExtras;
                             // localStorage.setItem('amount',amount);
      },function(err){
                 alert("err");
    } );
    }
})
