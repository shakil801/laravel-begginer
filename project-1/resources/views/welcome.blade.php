<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <!-- Styles -->
    <style>
        .form-control:focus {
            box-shadow: none;
        }

        input[type="text"] {
            padding: 1.5rem;
        }
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Todo Container */
.todo-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    padding: 20px;
    box-sizing: border-box;
    margin: 0px 10px;
}

/* Header */
.todo-header,.completed-header {
    font-size: 1.5em;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
    border-bottom: 2px solid #f4f4f9;
    padding-bottom: 10px;
}

/* Todo List */
.todo-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.todo-item ,.todo-done-item{
    background: #f9f9f9;
    border: 1px solid #ddd;
    padding: 10px 15px;
    margin-bottom: 10px;
    /* display:inline-block; */
    border-radius: 4px;
    transition: background 0.3s;
    position: relative;
    
}

.todo-item:hover {
    background: #e0e0e0;
}
.completed-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    padding: 20px;
    box-sizing: border-box;
    max-height: 600px;
    overflow-y: scroll;
}
.completed{
    
}
.delete-btn {
    position: absolute;
    top: 50%;
    right: 10px; /* Adjust this value as needed */
    transform: translateY(-50%);
    cursor: pointer;
    color: red;
    display: none;
}
.todo-done-item:hover .delete-btn {
    display: inline;
}
/* Add responsiveness */
@media (max-width: 600px) {
    .todo-container {
        width: 100%;
        margin: 10px;
    }
}
    </style>

</head>

<body class="container">
    <form action="{{route('todo.add')}}" method="post" class="mt-5">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="todo_title" placeholder="Todo Title">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">ADD</button>
            </div>
        </div>
    </form>

    <div class="todo-container">
        <h3 class="todo-header">Task</h3>
        <ul class="todo-list">
            @foreach ($todo as $todos)
            <li class="todo-item" data-id="{{$todos->item_id}}">{{$todos->title}}</li>
            @endforeach
        </ul>
    </div>

    <div class="completed-container">
        <h3 class="completed-header">Completed</h3>
        <div class="complete-list">
        <ul class="todo-list">
            @foreach ($complete_todo as $todos)
            <li class="todo-done-item">{{$todos->title}} <span class="delete-btn" data-id="{{$todos->item_id}}">Delete</span></li>
            @endforeach
        </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {

        $.ajax({
            url:'{{route("home")}}',
            type:'get',
            beforeSend: function(xhr) {
                    // Add CSRF token to headers
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success:function(response){

                },
        });
        $('.todo-item').click(function() {
            var todoId = $(this).data('id');
            var $todoItem = $(this);
            // Send AJAX request to update database with completed status
            $.ajax({
                type: 'POST',
                url: '/completed', // Change this to the actual route
                data: {
                    todo_id: todoId,
                    completed: true // Assuming you want to mark the todo as completed
                },
                beforeSend: function(xhr) {
                    // Add CSRF token to headers
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function(response) {
                    console.log('Todo marked as completed');
                    // You can also update the UI here if needed
                    $todoItem.css('text-decoration', 'line-through');
                },
                error: function(xhr, status, error) {
                    console.error('Error marking todo as completed:', error);
                }
            });
        });

        $(".delete-btn").on('click',function(){
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: '/delete', // Change this to the actual route
                data: {
                    todo_id: id,
                },
                beforeSend: function(xhr) {
                    // Add CSRF token to headers
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                },
                success: function(response) {
                    console.log('Todo marked as completed');
                    // You can also update the UI here if needed
                    $todoItem.css('text-decoration', 'line-through');
                },
                error: function(xhr, status, error) {
                    console.error('Error marking todo as completed:', error);
                }
            });
        });
    });
</script>
</body>

</html>