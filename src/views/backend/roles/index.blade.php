@extends('thor::backend.layout')
@section('main')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header clearfix">All Roles 
            {{ _d(link_to_route('backend.roles.create', '<i class="fa fa-plus"></i> Add new role', [], ['class'=>'btn btn-success pull-right'])) }}
        </h1>

        

        @if ($roles->count())
        <table class="table table-striped table-hover table-responsive widget-datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
<!--                    <th>Created at</th>
                    <th>Updated at</th>-->
                    <th class="al-r">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{{ $role->id }}}</td>
                    <td>{{{ $role->display_name }}}</td>
                    <td>{{{ $role->description }}}</td>
<!--                    <td>{{{ $role->created_at }}}</td>
                    <td>{{{ $role->updated_at }}}</td>-->
                    <td class="al-r">
                        {{ link_to_route('backend.roles.show', 'Show', array($role->id), array('class' => 'btn btn-sm btn-default')) }}
                        {{ link_to_route('backend.roles.edit', 'Edit', array($role->id), array('class' => 'btn btn-sm btn-primary')) }}
                        {{ Form::open(array('method' => 'DELETE', 'class' => 'inl-bl', 'route' => array('backend.roles.destroy', $role->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger btn-destroy')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        There are no roles        @endif
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
@stop