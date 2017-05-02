<div class="modal fade" id="newuser-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New User</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('users.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="task">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter user name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="User's email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" class="form-control" multiple>
                            @foreach($roles as $role)
                            <option value='{{$role->name}}'>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
