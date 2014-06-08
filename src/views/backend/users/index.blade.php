@extends('admin::layout')
@section('main')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Users</h1>

        <p>{{ _d(link_to_route('admin.users.create', '<i class="fa fa-plus"></i> Add new user')) }}</p>

        @if ($users->count())
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Confirmed</th>
                                        <th>Created at</th>
                    <th>Updated at</th>
                    <th class="al-r">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{{ $user->id }}}</td>
                                            <td>{{{ $user->username }}}</td>
                                            <td>{{{ $user->email }}}</td>
                                            <td>{{{ $user->confirmed }}}</td>
                                        <td>{{{ $user->created_at }}}</td>
                    <td>{{{ $user->updated_at }}}</td>
                    <td class="al-r">
                        {{ link_to_route('admin.users.show', 'Show', array($user->id), array('class' => 'btn btn-sm btn-default')) }}
                        {{ link_to_route('admin.users.edit', 'Edit', array($user->id), array('class' => 'btn btn-sm btn-info')) }}
                        {{ Form::open(array('method' => 'DELETE', 'class' => 'inl-bl', 'route' => array('admin.users.do_delete', $user->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger btn-destroy')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        There are no users        @endif
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
@stop