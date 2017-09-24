app.factory("myfactory",($http,$q)=>{
    var object =  {
		
		
        callserver : function(obj){
            console.log(obj)
            var pr = $q.defer();
				var url = "https://api.halanx.com/users/loginotp";
            console.log(obj);
				$http.get(url,obj).then(function(data){
					pr.resolve(data.data);
					 
                    alert("success")
				}
					,function(err){
					pr.reject(err);	
					console.log(" Error");
					});
            return pr.promise;
				}

			
				}
    return object;
			});