<footer class="main-footer">
    <strong>Copyright &copy; {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }} <a
            href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
