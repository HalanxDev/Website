app.factory("myfactory",($http,$q)=>{
    var object = {
        bill : function(key){
                       
              var pr = $q.defer();
         var url = "https://api.halanx.com/carts/detail";
        
                
         $http.get(url, {
//             withCredentials: true,
                headers: {
                    'Authorization': 'Token ' +key 
                }
         }).then(function(data){
             pr.resolve(data.data)
             console.log("success")
        
         },
                             function(err){
             pr.reject(err)
             console.log("error")
             
         }
         )
         return pr.promise
        },
         gettoken : function(){
         var token = localStorage.getItem("token")
           
          var mytoken=JSON.parse(token)
          return mytoken; 
        }
    }
    return object;
})