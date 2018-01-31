@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.requirements.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.requirements.title') }}
@endsection

@section('container')
    <div class="list-group m-b">
        @foreach($requirements['requirements'] as $type => $requirement)
            <a href="#" class="list-group-item {{ $phpSupportInfo['supported'] ? 'b-l-success' : 'b-l-danger' }}">
                <span class="pull-right {{ $phpSupportInfo['supported'] ? 'text-success' : 'text-danger' }}"><i class="fa fa-circle text-xs"></i></span> 
                <strong>{{ ucfirst($type) }}</strong>
                @if($type == 'php')
                    <strong>
                        <small>
                            (version {{ $phpSupportInfo['minimum'] }} required)
                        </small>
                    </strong>
                    <span class="float-right">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <i class="fa fa-fw fa-{{ $phpSupportInfo['supported'] ? 'check-circle-o' : 'exclamation-circle' }} row-icon" aria-hidden="true"></i>
                    </span>
                @endif
            </a>
        @endforeach
        @foreach($requirements['requirements'][$type] as $extention => $enabled)
            <a class="list-group-item {{ $phpSupportInfo['supported'] ? 'b-l-success' : 'b-l-danger' }}">
                <span class="pull-right {{ $phpSupportInfo['supported'] ? 'text-success' : 'text-danger' }}"><i class="fa fa-circle text-xs"></i></span>
                {{ $extention }}
                <i class="fa fa-fw fa-{{ $enabled ? 'check-circle-o' : 'exclamation-circle' }} row-icon" aria-hidden="true"></i>
            </a>
        @endforeach
    </div>
    @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] )
        <div class="buttons">
            <a class="btn btn-fw info" href="{{ route('LaravelInstaller::permissions') }}">
                {{ trans('installer_messages.requirements.next') }}
                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @endif

@endsection