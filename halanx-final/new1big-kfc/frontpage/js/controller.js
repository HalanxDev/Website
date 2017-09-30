app.controller("myctrl",($scope,myfactory)=>{
    storename();
    $scope.movex=fale;
    $scope.addsidebar = ()=>{
        $scope.movex= !$scope.movex;
    }
    function storename()
    {
        var promise = myfactory.callserver();
    promise.then(function(data){
        console.log(data)
        var Food  = data.filter(function(obj){
            return obj.StoreCategory == "Food" && obj.Verified == true;
        })
        var Grocery  = data.filter(function(obj){
            return obj.StoreCategory == "Grocery" && obj.Verified == true;
        })
       $scope.stores = Food;
         $scope.grocery= Grocery;
        console.log($scope.stores)
      },function(err){
        alert("err");   
    } );
    }
  
    $scope.select=(store)=>{
        console.log(store)
        myfactory.save(store.id)
    }
  $scope.storelist = ()=>{
        console.log($scope.store)
       var promise =  myfactory.storelist($scope.store)
           promise.then(function(data){
        console.log(data);
               $scope.list = data;
               
               console.log($scope.list)
//               for( i=0;i<$scope.list.length;i++){
//                  console.log($scope.list[i].source)
//               }
      
      },function(err){
//        alert("err");   
    } );
    }
    $scope.checkstore = (store)=>{
          myfactory.save(store._source.Id)
          
        console.log(store._source.Id)
       if(store._source.StoreCategory=="Food"){
            
             window.location = "https://www.halanx.com/halanx-final/new1big-kfc/food.html"
        }
        else if(store._source.StoreCategory=="Grocery"){
            window.location = "https://www.halanx.com/halanx-final/new1big-kfc/main.html"
        }
    }
   
})
