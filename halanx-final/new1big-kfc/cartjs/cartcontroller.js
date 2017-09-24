app.controller("cartctrl",function($scope,myfactory, $window){
    
    autoload();
    userid();
    
    
    function autoload()
 {
       
     $scope.cartproductlist = myfactory.load();
    $scope.totalamount   = myfactory.calculatetotal($scope.cartproductlist)
    if($scope.cartproductlist.length==0){
        $scope.cartclass = true;
          $scope.emptyclass = false;    
    }
     else{
          $scope.emptyclass = true;
     $scope.cartclass = false;
     }
 }
    function userid(){
        if(localStorage.token){
            var token = myfactory.gettoken();
            console.log(token)
          var promise =   myfactory.userid(token);
                  promise.then(function(data){
        console.log(data.id)
        myfactory.saveid(data.id);
        
 
      },function(err){
        alert("err");   
    } )  
            
        }
    }

    $scope.deleteproduct = (list)=>{
         console.log(list)
       list.Active = false;
        console.log(list)
     var finalarr =    myfactory.filterfunction($scope.cartproductlist)
     $scope.cartproductlist = finalarr;
        $scope.totalamount = myfactory.calculatetotal($scope.cartproductlist)
         var json = JSON.stringify($scope.cartproductlist)
          localStorage.setItem('storedata',json);
          console.log(localStorage)
          myfactory.load();
        var len = myfactory.cartlength($scope.cartproductlist);
         var json = JSON.stringify(len)
          localStorage.setItem('counter',json);
        if($scope.cartproductlist.length==0){
          $scope.emptyclass = false;
        $scope.cartclass = true;
    }
     else{
          $scope.emptyclass = true;
     $scope.cartclass = false;
     }
    }
    
   $scope.updateminus= (list)=>{
    list.quantity--;
     
       
       $scope.totalamount=myfactory.calculatetotal($scope.cartproductlist)
        var json = JSON.stringify($scope.cartproductlist)
          localStorage.setItem('storedata',json);
   }
   $scope.updateplus = (list)=>{
     
       
       list.quantity++;
      
    $scope.totalamount   = myfactory.calculatetotal($scope.cartproductlist)
     var json = JSON.stringify($scope.cartproductlist)
          localStorage.setItem('storedata',json);
   }

   $scope.submitcart = ()=>{
       

if(localStorage.token=="null"|| localStorage.token==null){
    $window.location.href = "https://www.halanx.com/halanx-final/new1big-kfc/frontpage/login.html";
}
       else{
           var token = myfactory.gettoken();
           var userid = myfactory.loadid();
           var i;
                  for( i=0;i<$scope.cartproductlist.length;i++){
           var obj = {};
//           obj.CartPhoneNo=mobilenumber;
                      obj.Cart = userid;
                      obj.Notes = "";
           obj.Item = $scope.cartproductlist[i].id;
          obj.Quantity =$scope.cartproductlist[i].quantity ;
      var promise = myfactory.callserver(obj,token)
          
       promise.then(function(data){
        console.log(data)
                         if(i==$scope.cartproductlist.length){
                          alert("Your Order is Ready!")
$window.location.href = "https://www.halanx.com/halanx-final/new1big-kfc/jquery%20datepicker/index.html"; 
                          
                     
           }

    },
                 function(err){
        alert("err")
        
    })
       }  
//         if(i==$scope.cartproductlist.length){
//           alert("loopover")
//           }  
       }
       
       
   }
})
