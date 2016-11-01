        
        </div>
    </div>
    <footer class="site-footer" role="contentinfo">
        <div class="logo-footer">
            @if(Theme::option('general','logo') != "")
                <img src="{{Theme::option('general','logo')}}" alt="qsoftvietnam" width="300">
            @else
                {{ Helper::option("site_title") }}
            @endif
        </div>
        <ul class="footer-social">
            <li><a href="{{((Theme::option('social_media','facebook') != "")?Theme::option('social_media','facebook'):'#')}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="{{((Theme::option('social_media','twitter') != "")?Theme::option('social_media','twitter'):'#')}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a href="{{((Theme::option('social_media','instagram') != "")?Theme::option('social_media','instagram'):'#')}}" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li><a href="{{((Theme::option('social_media','youtube') != "")?Theme::option('social_media','youtube'):'#')}}" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
        </ul>
        <div class="site-info">
            {!! Theme::option('general','copyright') !!}
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
	</div>
	<!-- JavaScripts -->
    <script src="{{URL::to('/')}}/assets/jquery/dist/jquery.min.js"></script>
    <script src="{{URL::to('/')}}/assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/bootstrap-submenu.min.js"></script>
    <script src="{{URL::to('/')}}/themes/smallpine/js/main.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @stack('scripts')
</body>
</html>