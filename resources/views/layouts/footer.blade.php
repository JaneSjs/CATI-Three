<footer class="footer">
        <div>
                © {{ date('Y') }} TIFA Research Ltd.
        </div>
        <div class="ms-auto">
                @env('local')
                        <b>Laravel Version</b>
                        {{ Illuminate\Foundation\Application::VERSION }}
                         (PHP v{{ PHP_VERSION }})
                @endenv
        </div>
</footer>