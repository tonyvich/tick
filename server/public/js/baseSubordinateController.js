var baseController = function ( 
    $scope,
    $http,
    tasksResource,
    taskGroupsResource
) 
{
    csrf_token                = $("#csrf_token").val();     // Contain the csrf_token
    $scope.content            = {};                         // Control the data displayed in content div    
    
    //-- Tasks Vars
    $scope.tasks              = {};                         // Contain all curent user tasks
    $scope.displayableTasks   = {};                         // Contain the task to be displayed
    $scope.task               = {};                         // Contain the task to save
    $scope.detail             = {};                         // Contain informations used to display details
    $scope.task               = {};                         // Contain the task working ( Add, Update )
    $scope.task.action        = 'add';                      // Action for new task modal set to add by default
    $scope.task.actionDone    = false;
    $scope.taskLabels         = {}                          // Contain numbers for labels of lists

    /**
     * Display deleted tasks
     */

    $scope.displayDeletedTasks      = function(){
        $scope.content.display = "task";
        $scope.displayableTasks = [];
        $.each($scope.tasks, function(i, task){
            if( task.deleted == 1 ){
                $scope.displayableTasks.push( task );
            }
        });
    }

    /**
     *  Display outdated tasks 
     */

    $scope.displayOutdatedTasks      = function(){
        $scope.displayableTasks = [];
        $scope.content.display = "task";
        date     = new Date();
        $.each($scope.tasks, function(i, task){
            if( typeof task.ends_at !== 'undefined' && task.ends_at !== null && task.deleted == 0){
                // The task is scheduled
                taskDate = new Date( task.ends_at );
                if( taskDate.getTime() < date.getTime() ){
                    // The task is outdated
                    $scope.displayableTasks.push( task );
                }
            }
        });
    }

    /**
     *  Display Today tasks 
     */

    $scope.displayTodayTasks      = function(){
        $scope.displayableTasks = [];
        $scope.content.display = "task";
        $.each($scope.tasks, function(i, task){
            if( typeof task.ends_at !== 'undefined' ){
                // The task is scheduled
                date     = new Date();
                taskDate = new Date( task.ends_at );
                if( taskDate.toDateString() == date.toDateString() && task.deleted == 0 ){
                    // The task is outdated
                    $scope.displayableTasks.push( task );
                }
            }
        });
    }

    /**
     * Display Completed tasks
     */

    $scope.displayCompletedTasks    = function(){
        $scope.displayableTasks = [];
        $scope.content.display = "task";
        $.each($scope.tasks, function(i, task){
            if( task.completed == 1 && task.deleted == 0 ){
                $scope.displayableTasks.push( task );
            }
        });
    }

    /**
     * Display Not Scheduled tasks
     */

    $scope.displayNotScheduledTasks    = function(){
        $scope.displayableTasks = [];
        $scope.content.display = "task";
        $.each($scope.tasks, function(i, task){
            if( task.scheduled == 0 && task.deleted == 0 ){
                $scope.displayableTasks.push( task );
            }
        });
    }

    /**
     * Get Data ( Load all data )
     * @param
     * @return 
     */
    
     $scope.getData                  = function(){
        tasksResource.get().then( function( returned ){
            $scope.tasks            =  returned.data.tasks;
            $scope.displayableTasks =  [];
            tasks                   =  $scope.tasks;
            // Counting tasks
            $scope.taskLabels.all          = 0;        // All tasks number
            $scope.taskLabels.completed    = 0;        // Completed tasks number
            $scope.taskLabels.today        = 0;        // Today tasks number
            $scope.taskLabels.notScheduled = 0;        // Not Scheduled task
            $scope.taskLabels.outdated     = 0;        // Outdated task
            $scope.taskLabels.deleted      = 0;        // Deleted task
            date = new Date();                         // The current date
            
            $.each($scope.tasks, function(i, task){
                if ( task.completed == 1 && task.deleted == 0){
                    $scope.taskLabels.completed++; 
                }
                if( typeof task.ends_at !== 'undefined' && task.ends_at !== null && task.deleted == 0){
                    // The task is scheduled
                    taskDate = new Date( task.ends_at );
                    if( taskDate.toDateString() == date.toDateString() ){
                        // The task is today
                        $scope.taskLabels.today++;    
                    }
                    if( taskDate.getTime() < date.getTime() ){
                        // The task is outdated
                        $scope.taskLabels.outdated++;
                    }
                } 
                if( task.scheduled == 0 ){
                    $scope.taskLabels.notScheduled++;
                }
                if( task.deleted == 1){
                    $scope.taskLabels.deleted++;
                } else {
                    $scope.taskLabels.all++;
                    $scope.displayableTasks.push( task );   // Display not deleted tasks 
                }
            });
        });
        $scope.closeDetail();
        $scope.content.display = "task";
        $('#all-task-tab-link').attr('class','active');
    }

    /**
     * Update task
     * @param task (Not Required) The task to update
     * @param action ( Not Required ) Mark completed, uncompleted or delete
     */

    $scope.updateTask     = function ( task, action ){
        if ( typeof task !== 'undefined' ){
            if( action == 'delete' ){
                
            } else {
                if( action == "mark_completed" ){
                    task.completed   =  1;   
                } else if( action == "mark_not_completed" ){
                    task.completed   =  0;
                }
                tasksResource.update( task ).then( function ( returned ){
                    if( returned.status == 200 ){
                        $scope.task.actionDone = true;
                        $scope.alertMessage( '#message-tasks-content', 'success', '"' + task.name + '" Has been updated succesfully');
                        $("#modal-new-task").modal('hide');
                    } else {
                        $("#modal-new-task").modal('hide');
                        $scope.alertMessage( '#message-tasks-content', 'error', 'An error happened while updating task please retry');
                    }
                });
            }   
        }
    }

    /**
     * Alert message display a message on action 
     */
    $scope.alertMessage          = function( element, type, message ){
        if( type == "success" ){
            $( element ).attr('class', 'alert alert-success');
            $( element ).html( message );
            $( element ).fadeIn( 2000 );
            $( element ).fadeOut( 10000 );
        }
        if( type == "error" ){
            $( element ).attr('class', 'alert alert-warning');
            $( element ).html( message );
            $( element ).fadeOut( 10000 );
        }
        if( type == "info" ){
            $( element ).attr('class', 'alert alert-info');
            $( element ).html( message );
            $( element ).fadeIn( 2000 );
            $( element ).fadeOut( 10000 );
        }
    }

    /**
     * Close Detail division 
     */

    $scope.closeDetail            = function(){
        $('#detail').removeClass('show');
    }

    $scope.getData();
}

baseController.$inject = [
    '$scope',
    '$http',
    'tasksResource',
    'taskGroupsResource'
];

taskManager.controller( 'baseController', baseController );