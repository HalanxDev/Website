app.factory("myfactory",($http,$q)=>{
    var object = {
        
             load : function(){
          var usedata = localStorage.getItem("storedata")
              console.log(usedata)
          pushdata=JSON.parse(usedata)
          return pushdata;
     },
        filterfunction : function(filterlist){
            console.log(filterlist)
         var finalarr =    filterlist.filter(function(obj){
             return obj.Active == true
         })
           
            console.log(finalarr)
            return finalarr
            
        },
        loadid : function(){
            
           var usedata = localStorage.getItem("userid")
              
          var userid=JSON.parse(usedata)
//          console.log(counter)
          return userid;
        },
         saveid : function(data){
                     var json = JSON.stringify(data)
         localStorage.setItem('userid',json);
            console.log(localStorage)
        },
        calculatetotal : function(productarr){
            var sum=0
            for(var i=0;i<productarr.length;i++){
              sum = sum + (productarr[i].Price*productarr[i].quantity)  
            }
            return sum
        },
          cartlength : function(arr){
              
           console.log(arr.length)
        return arr.length;
    },
          gettoken : function(){
         var token = localStorage.getItem("token")
           
          var mytoken=JSON.parse(token)
          return mytoken; 
        },
        userid : function(key){
          var pr = $q.defer();
            
         var url = "https://api.halanx.com/carts/detail/";
            console.log(key);
        
         $http.get(url, {
//                withCredentials: true,
                headers: {
                    'Authorization': 'Token ' + key 
                }
            }).then(function(data){
             pr.resolve(data.data)
             console.log("success")
           
         },
                             function(err){
             pr.reject(err)
             console.log("error")
           console.log("token",key)
           
             
             
         }
         )
         return pr.promise
    },

        callserver : function(obj,key){
        console.log(obj)
        var pr = $q.defer();
            var url = "https://api.halanx.com/carts/items/"
            $http.post(url,obj, {
//             withCredentials: true,
                headers: {
                    'Authorization': 'Token ' +key 
                }
         }).then(function(data){
                pr.resolve(data);
                console.log("success")
            },
                             function(err){
                pr.reject(err);
                console.log("error")
            })
            return pr.promise
    },
        getnumber : ()=>{
       var mobilenumber=localStorage.getItem("mobilenumber");
        return mobilenumber;
        
    }

    }
    return object
})