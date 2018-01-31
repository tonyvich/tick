@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.environment.wizard.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-list fa-fw" aria-hidden="true"></i>
    Environment overview
@endsection

@section('container')
    <div>
        {{ $envConfig }}
    </div>
    <hr>
    @if( $status == "success" )
        <div>
            <a href="{{ route('LaravelInstaller::database') }}" class="btn btn-fw info">
                Migrate database
                <i class="fa fa-database fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    @else
        <div>
            <p>Tick master was unable to connect to your database</p>
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn danger">
                <i class="fa fa-angle-left fa-fw" aria-hidden="true"></i>
                Review parameters
            </a>
        </div>
    @endif
@endsection

@section( 'scripts' )
    <script>
        $( 'document' ).ready( function(){
            $( '.center-block w-auto-xs p-y-md text-center' ).css( 'width', '450px' );
        });
    </script>
@endsection