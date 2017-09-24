app.factory("myfactory",()=>{
  var object = {
       desired : function(){
            return ([{service:"as soon as possible",mark:true},{service:"schedule for later",mark:false}])
        },
            check(search){
  
  var get =  search.filter(function(check){

        return(check.mark ==true);
    })
 
  console.log(get[0].mark);
        
get[0].mark = !get[0].mark;
  console.log(get)
        
 
    },
           time : function(){
            return ([{timing:"9:30pm-10:00pm",mark:true},{timing:"9:45pm-10:15pm",mark:false},{timing:"10:00pm-10:30pm",mark:false},{timing:"10:15pm-10:45pm",mark:false},{timing:"10:30pm-11:00pm",mark:false},{timing:"10:45pm-11:15pm",mark:false},{timing:"11:00pm-11:30pm",mark:false},{timing:"11:15pm-11:45pm",mark:false},{timing:"11:30pm-12:00am",mark:false}])
        },
      gettrue(search){
          var get = search.filter(function(check){
              return(check.mark == true);
          })
          return get[0];
      }
      
  }  
  return object
})