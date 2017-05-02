var task_table = document.querySelector('#xx thead');
var csrf = document.getElementsByName("csrf-token")[0].content;

window.onload = function() {
    /* index */
    ajax('/all-tasks', 'GET', '', { 'X-CSRF-TOKEN' : csrf }).then(function(json) {
        var tasks = JSON.parse(json.response);
        for(var i=0; i < tasks.length; i++) {
            var task_id = tasks[i].id;
            var task_name = tasks[i].task;
            var description = tasks[i].description;
            var done = tasks[i].done;
            var task_column = '<tr id="todo"><td class="task_id" hidden>'+task_id+'</td><td class="task-content">'+task_name+'</td><td class="task-content">'+description+'</td><td class="task-content">'+done+'</td><td class="text-center edit-and-delete"><a id="edit-button" class="btn btn-info btn-xs editbtn" href="#"><span></span>Edit</a><a id="delete-button" class="btn btn-danger btn-xs"><span></span>Del</a></td></tr>';
            // var task_column = '<tr id="todo"> <td class="task_id" hidden>'+task_id+'</td><td class="task-content">'+task_name+'</td><td class="task-content">'+description+'</td><td class="task-content">'+done+'</td><td class="text-center edit-and-delete"><a id="edit-button" class="btn btn-info btn-xs editbtn" href="#"><span></span>Edit</a><a '{{ @permission('delete') }}' id="delete-button" '{{ @endpermission('delete') }}' class="btn btn-danger btn-xs"><span></span>Del</a></td></tr>';
            if (!task_table.nextElementSibling) {
                task_table.insertAdjacentHTML('beforeend', task_column);
                console.log('Yeah, hun!');
            }
        }
        var edit_buttons = document.querySelectorAll('#edit-button');
        var delete_buttons = document.querySelectorAll('#delete-button');

        // EDIT EVENT (On every single edit-button)
        document.addEventListener('click', function (e) {
            console.log(e.target);
            if(e.target.id === 'edit-button')
            {
                var this_todo_row = e.target.closest('#todo');
                var this_todo = e.target.closest('#todo').getElementsByClassName('task-content');
                var buttons = e.target.closest('#todo').getElementsByClassName('edit-and-delete');

                // make table cells editable like inputs
                for(var i=0; i < this_todo.length; i++) {
                    this_todo[i].setAttribute("contenteditable", "true");
                    this_todo[i].style.border = '3px solid red';
                }

                // along the way, instead of edit and delete, we need SAVE button to replace them with
                while (buttons[0].firstChild) {
                    buttons[0].removeChild(buttons[0].firstChild);
                }
                buttons[0].insertAdjacentHTML('beforeend','<a id="save-button" class="btn btn-info btn-xs savebtn" href="#"><span></span>SAVE</a>');

                // save updated task
                var save_button = this_todo_row.getElementsByClassName('savebtn');
                save_button[0].addEventListener('click', function () {
                    var new_content = this.closest('#todo').getElementsByClassName('task-content');
                    var this_id = this.closest('#todo').getElementsByClassName('task_id')[0].innerHTML;
                    var updated_task = {};
                    for(var i = 0; i < new_content.length; i++) {
                        updated_task = {
                            "task": new_content[0].innerHTML,
                            "description": new_content[1].innerHTML,
                            "done": new_content[2].innerHTML
                        };
                    }
                    ajax('/tasks/'+this_id+'', 'POST', updated_task, { 'X-CSRF-TOKEN' : csrf }).then(function(json) {
                        while (buttons[0].firstChild) {
                            buttons[0].removeChild(buttons[0].firstChild);
                        }
                        buttons[0].insertAdjacentHTML('beforeend','<a id="edit-button" class="btn btn-info btn-xs editbtn" href="#"><span></span>Edit</a><a id="delete-button" class="btn btn-danger btn-xs"><span></span>Del</a>');
                        for(var i=0; i < this_todo.length; i++) {
                            this_todo[i].removeAttribute("contenteditable");
                            // remove inline style (border)
                            this_todo[i].removeAttribute("style");
                        }
                    }).catch(function(err) {
                        console.log(err);
                    });
                });
                // delete task
            } else if(e.target.id === 'delete-button') {
                var this_id = e.target.closest('#todo').getElementsByClassName('task_id')[0].innerHTML;
                ajax('/tasks/'+this_id+'', 'DELETE', '', { 'X-CSRF-TOKEN' : csrf }).then(function(json) {
                    console.log(json);
                }).catch(function(err) {
                    console.log(err);
                });
                e.target.closest('#todo').remove();
    }})

    }).catch(function(err) {
        console.log(err);
    })};




