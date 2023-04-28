<footer class="footer sticky-bottom">
        <div>
                @env('local')
                        <b>Laravel Version</b>
                        {{ Illuminate\Foundation\Application::VERSION }}
                         (PHP v{{ PHP_VERSION }})
                @endenv
                @env('production')
                        <p>CATI Version 3.0</p>
                @endenv
        </div>
        <div class="ms-auto">
                © {{ date('Y') }} TIFA Research Ltd.
        </div>
</footer>