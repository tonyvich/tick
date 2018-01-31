@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.permissions.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-key fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.permissions.title') }}
@endsection

@section('container')

    <div class="list-group m-b">
        @foreach($permissions['permissions'] as $permission)
        <a href="#" class="list-group-item {{ $permission['isSet'] ? 'b-l-success' : 'b-l-danger' }}">
            <span class="pull-right {{ $permission['isSet'] ? 'text-success' : 'text-danger' }}"><i class="fa fa-circle text-xs"></i></span>
            {{ $permission['folder'] }}
            <span>
                :{{ $permission['permission'] }}
            </span>
        </a>
        @endforeach
    </div>

    @if ( ! isset($permissions['errors']))
        <div class="buttons">
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-fw info">
                {{ trans('installer_messages.permissions.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection