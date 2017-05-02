@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row col-md-6 col-md-offset-2 custyle">
            <table class="table table-bordered" id="xx">
                <thead>
                <tr>
                    <th>Task <a href="#" class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#newtask-modal">New</a></th>
                    <th>Description</th>
                    <th>Done</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
            </table>
            <div class="modal fade" id="newtask-modal" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add New Task</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('new-task')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="task">Task:</label>
                                    <input type="text" class="form-control" id="task" placeholder="Enter task content" name="task">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" placeholder="Describe more" name="description">
                                </div>
                                <div class="form-group" hidden>
                                    <label for="done"></label>
                                    <input type="text" class="form-control" id="done" name="done" value="0" readonly>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                        {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                        {{--</div>--}}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
