<footer class="footer">
        <div>
                 @env('local')
                        <b>Laravel Version</b>
                        {{ Illuminate\Foundation\Application::VERSION }}
                         (PHP v{{ PHP_VERSION }})
                @endenv
        </div>
        <div class="ms-auto">
                © {{ date('Y') }} TIFA Research Ltd.
        </div>
</footer>