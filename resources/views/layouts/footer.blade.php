@if(request()->segment(1) !== 'begin_survey')
<footer class="footer sticky-bottom">
        <div>
                @env('production')
                        <p>CATI Version 3.0</p>
                @else
                        <b>Laravel Version</b>
                        {{ Illuminate\Foundation\Application::VERSION }}
                         (PHP v{{ PHP_VERSION }})
                @endenv
        </div>
        <div class="ms-auto">
                © {{ date('Y') }} TIFA Research Ltd.
        </div>
</footer>
@endif