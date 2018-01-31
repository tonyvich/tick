taskManager.factory( 
    'tasksResource', 
    function(
        $http 
    ){
        var factory = {};
        var baseUrl = $("#app_url").val(); 

        /**
         * Get Tasks ( Get the connected user tasks )
         * @param
         * @return
         */

        factory.get        =  function (){
            return $http.get(baseUrl + "/tasks");
        };
        
        /**
         * Create (add a task to the database )
         * @param task
         * @return json
         */

        factory.create     =  function ( task ){
            return $http.post(baseUrl + '/tasks', task, {headers: {'X-Requested-With': 'XMLHttpRequest' }});
        };

        /**
         * Update ( update task on database )
         * @param task
         * @return
         */

        factory.update       =  function ( task ){
             return $http.put(baseUrl + '/tasks', task, {headers: {'X-Requested-With': 'XMLHttpRequest'}});        
        };
        
        /**
         * Delete ( delete task on database )
         * @param task
         * @return
         */

        factory.delete       =  function ( task ){
             return $http.delete(baseUrl + '/tasks/' + task.id, task, {headers: {'X-Requested-With': 'XMLHttpRequest'}});        
        };

        return factory;
    }
);